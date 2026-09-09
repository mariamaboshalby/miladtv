@php
    $hasChildren = $node->allChildren->isNotEmpty();
    $depthLabels = ['فئة رئيسية', 'فئة فرعية', 'تفصيل', 'مستوى 4'];
    $depthLabel  = $depthLabels[$depth] ?? ('مستوى ' . ($depth + 1));
@endphp

<div class="tree-node">
    <div class="tree-node-row" data-depth="{{ $depth }}">

        {{-- Expand toggle --}}
        <button type="button"
                class="tree-toggle {{ $hasChildren ? '' : 'leaf' }} {{ $hasChildren ? 'open' : '' }}"
                data-node="{{ $node->id }}"
                title="{{ $hasChildren ? 'طيّ / فتح' : '' }}">
            <i class="fas fa-chevron-right"></i>
        </button>

        {{-- Thumb --}}
        <div class="tree-node-thumb">
            @if($node->image)
                <img src="{{ asset('storage/' . $node->image) }}" alt="{{ $node->name_ar }}">
            @else
                <i class="fas fa-{{ $node->icon ?: 'tag' }}"></i>
            @endif
        </div>

        {{-- Info --}}
        <div class="tree-node-info">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="tree-node-name">{{ $node->name_ar }}</span>
                <span style="color:#94a3b8;font-size:.8rem;">/ {{ $node->name_en }}</span>
                <span class="badge-depth badge-depth-{{ min($depth,3) }}">{{ $depthLabel }}</span>
                @if(!$node->is_active)
                    <span class="badge badge-red" style="font-size:.7rem;">{{ __('app.inactive') }}</span>
                @endif
            </div>
            <div class="tree-node-meta">
                <code>{{ $node->slug }}</code>
                @if($node->icon)
                    <span><i class="fas fa-{{ $node->icon }}" style="color:var(--primary);"></i> {{ $node->icon }}</span>
                @endif
                @if($node->sort_order)
                    <span><i class="fas fa-sort-numeric-down"></i> {{ $node->sort_order }}</span>
                @endif
                @if($hasChildren)
                    <span><i class="fas fa-folder-open" style="color:#6366f1;"></i> {{ $node->allChildren->count() }} فئة فرعية</span>
                @endif
            </div>
            @if($node->description)
                <div class="tree-node-desc" title="{{ $node->description }}">
                    <i class="fas fa-align-left" style="color:#cbd5e1;margin-inline-end:.3rem;"></i>{{ $node->description }}
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="d-flex align-items-center gap-1 flex-shrink-0">
            {{-- Add child --}}
            <a href="{{ route('admin.categories.create', ['parent_id' => $node->id]) }}"
               class="btn btn-sm"
               style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;border-radius:8px;padding:.3rem .6rem;font-size:.78rem;"
               title="إضافة فئة فرعية">
                <i class="fas fa-plus"></i>
            </a>
            {{-- Edit --}}
            <a href="{{ route('admin.categories.edit', $node) }}"
               class="btn btn-secondary btn-sm"
               style="border-radius:8px;padding:.3rem .6rem;font-size:.78rem;"
               title="{{ __('app.edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            {{-- Delete --}}
            <form method="POST" action="{{ route('admin.categories.destroy', $node) }}"
                  onsubmit="return confirm('{{ __('app.delete_category_confirm') }}')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm"
                        style="border-radius:8px;padding:.3rem .6rem;font-size:.78rem;"
                        title="{{ __('app.delete') }}">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>

    </div>{{-- /.tree-node-row --}}

    {{-- Recursive children --}}
    @if($hasChildren)
    <div class="tree-children" id="children-{{ $node->id }}">
        @foreach($node->allChildren as $child)
            @include('admin.categories._tree_node', ['node' => $child, 'depth' => $depth + 1])
        @endforeach
    </div>
    @endif

</div>{{-- /.tree-node --}}
