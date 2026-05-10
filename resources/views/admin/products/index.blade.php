@extends('admin.layouts.app')

@section('title', 'المنتجات')
@section('page-title', 'إدارة المنتجات')
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <span>المنتجات</span>
@endsection

@section('content')

<!-- Toolbar -->
<div class="toolbar">
    <form class="toolbar-search" method="GET" action="{{ route('admin.products.index') }}">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="بحث بالاسم أو الماركة..." value="{{ request('search') }}">
        </div>
        <select name="category" class="form-control" style="width:180px">
            <option value="">كل الفئات</option>
            <option value="printers"  {{ request('category')=='printers'  ? 'selected':'' }}>الطابعات</option>
            <option value="mice"      {{ request('category')=='mice'      ? 'selected':'' }}>الماوسات</option>
            <option value="headphones"{{ request('category')=='headphones'? 'selected':'' }}>السماعات</option>
            <option value="flash"     {{ request('category')=='flash'     ? 'selected':'' }}>الفلاشات</option>
        </select>
        <select name="status" class="form-control" style="width:150px">
            <option value="">كل الحالات</option>
            <option value="active"   {{ request('status')=='active'   ? 'selected':'' }}>نشط</option>
            <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>معطل</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> بحث</button>
        @if(request()->hasAny(['search','category','status']))
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> مسح</a>
        @endif
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> إضافة منتج
    </a>
</div>

<!-- Table -->
<div class="card">
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المنتج</th>
                    <th>الفئة</th>
                    <th>السعر</th>
                    <th>المخزون</th>
                    <th>الحالة</th>
                    <th>مميز</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="color:var(--gray-400);font-size:.875rem">{{ $product->id }}</td>
                    <td>
                        <div class="product-cell">
                            <div class="product-thumb">
                                <i class="fas fa-{{ $product->category === 'printers' ? 'print' : ($product->category === 'mice' ? 'mouse' : ($product->category === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                            </div>
                            <div>
                                <strong>{{ $product->name }}</strong>
                                <span style="display:block;font-size:.8125rem;color:var(--gray-500)">{{ $product->brand }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php $cats = ['printers'=>'الطابعات','mice'=>'الماوسات','headphones'=>'السماعات','flash'=>'الفلاشات']; @endphp
                        <span class="badge badge-blue">{{ $cats[$product->category] ?? $product->category }}</span>
                    </td>
                    <td>
                        <strong style="color:var(--primary-blue)">{{ number_format($product->price) }} ج</strong>
                        @if($product->old_price)
                        <span style="display:block;font-size:.8125rem;color:var(--gray-400);text-decoration:line-through">{{ number_format($product->old_price) }} ج</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $product->stock == 0 ? 'badge-red' : ($product->stock < 10 ? 'badge-orange' : 'badge-green') }}">
                            {{ $product->stock == 0 ? 'نفد' : $product->stock . ' قطعة' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $product->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $product->is_active ? 'نشط' : 'معطل' }}
                        </span>
                    </td>
                    <td>
                        @if($product->is_featured)
                        <i class="fas fa-star" style="color:#F59E0B;font-size:1.25rem"></i>
                        @else
                        <i class="far fa-star" style="color:var(--gray-300);font-size:1.25rem"></i>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm" title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="حذف"
                                    data-confirm="هل أنت متأكد من حذف هذا المنتج؟">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <p>لا توجد منتجات</p>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">إضافة منتج</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div style="padding:1.5rem;border-top:1px solid var(--gray-200)">
        {{ $products->withQueryString()->links('admin.pagination') }}
    </div>
    @endif
</div>

@endsection

@push('styles')
<style>
.toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.toolbar-search {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
    flex: 1;
}

.search-box {
    position: relative;
    flex: 1;
    min-width: 220px;
}

.search-box i {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
}

.search-box input {
    width: 100%;
    padding: 0.75rem 2.75rem 0.75rem 1.25rem;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-family: inherit;
    font-size: .9375rem;
    transition: var(--transition);
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 4px rgba(0,86,210,.1);
}

.product-cell {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.product-thumb {
    width: 45px;
    height: 45px;
    background: var(--secondary-blue);
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-blue);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: var(--gray-400);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}
</style>
@endpush
