<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    protected $fillable = [
        'parent_id', 'slug', 'name_ar', 'name_en',
        'icon', 'image', 'description', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Accessors ────────────────────────────────────────────────────────────

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /** True if this is a root-level category (no parent) */
    public function getIsRootAttribute(): bool
    {
        return is_null($this->parent_id);
    }

    /** Depth level: 0 = root, 1 = child, 2 = grandchild … */
    public function getDepthAttribute(): int
    {
        $depth = 0;
        $node  = $this;
        while (! is_null($node->parent_id)) {
            $depth++;
            $node = $node->parent;
            if ($depth > 10) break; // safety guard
        }
        return $depth;
    }

    // ── Relationships ────────────────────────────────────────────────────────

    /** Direct parent category */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /** Direct children (one level down) */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
                    ->orderBy('sort_order')
                    ->orderBy('name_ar');
    }

    /** Recursively eager-load all descendants */
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /** Products whose category slug matches this category */
    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'slug');
    }

    // ── Scopes ───────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Only root categories */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    /** Only children of a given parent */
    public function scopeChildrenOf($query, int $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    // ── Static Helpers ───────────────────────────────────────────────────────

    /**
     * Return the full tree as a nested Collection:
     *   roots → children → grandchildren …
     * Each node has a 'children' relation already loaded.
     */
    public static function tree(bool $activeOnly = false): Collection
    {
        $query = static::with('allChildren')->roots();
        if ($activeOnly) {
            $query->active();
        }
        return $query->orderBy('sort_order')->orderBy('name_ar')->get();
    }

    /**
     * Flat list with indentation prefix for <select> dropdowns.
     * Returns array of ['id' => …, 'label' => '— — Name']
     */
    public static function flatListForSelect(?int $excludeId = null): array
    {
        $all   = static::orderBy('sort_order')->orderBy('name_ar')->get()->keyBy('id');
        $roots = $all->filter(fn($c) => is_null($c->parent_id));

        $result = [];
        $walk   = function ($nodes, int $depth) use (&$walk, $all, $excludeId, &$result) {
            foreach ($nodes as $node) {
                if ($excludeId && $node->id === $excludeId) continue;
                $prefix          = str_repeat('— ', $depth);
                $result[]        = [
                    'id'    => $node->id,
                    'label' => $prefix . $node->name_ar . ' / ' . $node->name_en,
                    'depth' => $depth,
                ];
                $children = $all->filter(fn($c) => $c->parent_id === $node->id);
                if ($children->isNotEmpty()) {
                    $walk($children, $depth + 1);
                }
            }
        };

        $walk($roots, 0);
        return $result;
    }

    /**
     * Collect this category's slug + all descendant slugs.
     * Used to filter products by an entire subtree.
     */
    public function descendantSlugs(): array
    {
        $slugs = [$this->slug];
        foreach ($this->allChildren as $child) {
            $slugs = array_merge($slugs, $child->descendantSlugs());
        }
        return array_unique($slugs);
    }
}
