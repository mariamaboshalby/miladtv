@extends('admin.layouts.app')
@section('title', __('app.manage_categories'))
@section('page-title', __('app.categories'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <span>{{ __('app.categories') }}</span>
@endsection

@section('content')

{{-- Header --}}
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-header">
        <h2>
            <i class="fas fa-sitemap" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i>
            {{ __('app.categories') }}
            <span style="font-size:.85rem;font-weight:500;color:#64748b;margin-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}:.5rem;">({{ $totalCount }} فئة)</span>
        </h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> {{ __('app.new_category') }}
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:1rem;padding:.75rem 1rem;border-radius:8px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

{{-- Tree --}}
@if($tree->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-sitemap"></i><p>{{ __('app.no_categories_found') }}</p></div></div>
@else
    <div class="category-tree">
        @foreach($tree as $root)
            @include('admin.categories._tree_node', ['node' => $root, 'depth' => 0])
        @endforeach
    </div>
@endif

@push('styles')
<style>
/* ── Tree Wrapper ── */
.category-tree { display:flex; flex-direction:column; gap:.5rem; }

/* ── Single node card ── */
.tree-node { border-radius:12px; overflow:hidden; }

.tree-node-row {
    display:flex;
    align-items:center;
    gap:.75rem;
    padding:.65rem 1rem;
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:12px;
    transition:box-shadow .18s, border-color .18s;
    position:relative;
}
.tree-node-row:hover { box-shadow:0 2px 12px rgba(5,24,54,.08); border-color:#cbd5e1; }

/* depth indents */
.tree-node-row[data-depth="1"] { margin-inline-start:1.75rem; border-inline-start:3px solid #bfdbfe; border-radius:0 12px 12px 0; }
.tree-node-row[data-depth="2"] { margin-inline-start:3.5rem;  border-inline-start:3px solid #a5f3fc; border-radius:0 12px 12px 0; }
.tree-node-row[data-depth="3"] { margin-inline-start:5.25rem; border-inline-start:3px solid #d9f99d; border-radius:0 12px 12px 0; }
.tree-node-row[data-depth="4"] { margin-inline-start:7rem;    border-inline-start:3px solid #fde68a; border-radius:0 12px 12px 0; }

/* connector line for depth > 0 */
.tree-node-row[data-depth]:not([data-depth="0"])::before {
    content:'';
    position:absolute;
    top:50%;
    inset-inline-start:-1.25rem;
    width:1rem;
    height:1px;
    background:#cbd5e1;
}

/* ── Node icon / image ── */
.tree-node-thumb {
    width:40px; height:40px; border-radius:8px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    background:#f1f5f9; color:#64748b; font-size:1.15rem;
    border:1px solid #e2e8f0; overflow:hidden;
}
.tree-node-thumb img { width:100%; height:100%; object-fit:cover; }

/* ── Expand toggle ── */
.tree-toggle {
    width:24px; height:24px; border-radius:50%;
    border:1px solid #e2e8f0; background:#f8fafc; color:#64748b;
    display:flex; align-items:center; justify-content:center;
    font-size:.7rem; cursor:pointer; flex-shrink:0;
    transition:background .15s, color .15s, transform .2s;
}
.tree-toggle:hover { background:#051836; color:#fff; border-color:#051836; }
.tree-toggle.open { background:#051836; color:#fff; border-color:#051836; }
.tree-toggle.open i { transform:rotate(90deg); }
.tree-toggle.leaf { visibility:hidden; }

/* ── Node info ── */
.tree-node-info { flex:1; min-width:0; }
.tree-node-name { font-weight:700; font-size:.9rem; color:#0f172a; }
.tree-node-meta { font-size:.78rem; color:#94a3b8; display:flex; flex-wrap:wrap; gap:.4rem; align-items:center; margin-top:.1rem; }
.tree-node-meta code { background:#f1f5f9; border-radius:4px; padding:0 .35rem; font-size:.75rem; }
.tree-node-desc { font-size:.78rem; color:#64748b; margin-top:.2rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:420px; }

/* ── Children container ── */
.tree-children { display:flex; flex-direction:column; gap:.5rem; margin-top:.5rem; }
.tree-children.collapsed { display:none; }

/* ── Badges ── */
.badge-depth {
    font-size:.7rem; padding:.2rem .5rem; border-radius:20px; font-weight:600;
}
.badge-depth-0 { background:#dbeafe; color:#1d4ed8; }
.badge-depth-1 { background:#ede9fe; color:#6d28d9; }
.badge-depth-2 { background:#ccfbf1; color:#0f766e; }
.badge-depth-3 { background:#fef9c3; color:#92400e; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tree-toggle:not(.leaf)').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var nodeId  = btn.dataset.node;
            var list    = document.getElementById('children-' + nodeId);
            if (!list) return;
            var isOpen = !list.classList.contains('collapsed');
            list.classList.toggle('collapsed', isOpen);
            btn.classList.toggle('open', !isOpen);
        });
    });
});
</script>
@endpush

@endsection
