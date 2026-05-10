@extends('admin.layouts.app')

@section('title', 'المستخدمون')
@section('page-title', 'إدارة المستخدمين')
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <span>المستخدمون</span>
@endsection

@section('content')

<!-- Stats -->
<div class="stats-grid" style="margin-bottom:1.5rem">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div class="stat-content"><h3>{{ $stats['total'] }}</h3><p>إجمالي المستخدمين</p></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-user-shield"></i></div>
        <div class="stat-content"><h3>{{ $stats['admins'] }}</h3><p>المديرون</p></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-user-check"></i></div>
        <div class="stat-content"><h3>{{ $stats['active'] }}</h3><p>مستخدمون نشطون</p></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-user-plus"></i></div>
        <div class="stat-content"><h3>{{ $stats['new_this_month'] }}</h3><p>جدد هذا الشهر</p></div>
    </div>
</div>

<!-- Toolbar -->
<div class="toolbar">
    <form class="toolbar-search" method="GET" action="{{ route('admin.users.index') }}">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="بحث بالاسم أو البريد أو الهاتف..." value="{{ request('search') }}">
        </div>
        <select name="role" class="form-control" style="width:160px">
            <option value="">كل الأدوار</option>
            <option value="admin" {{ request('role')=='admin' ? 'selected':'' }}>👑 مدير</option>
            <option value="user"  {{ request('role')=='user'  ? 'selected':'' }}>👤 مستخدم</option>
        </select>
        <select name="status" class="form-control" style="width:150px">
            <option value="">كل الحالات</option>
            <option value="active"   {{ request('status')=='active'   ? 'selected':'' }}>✅ نشط</option>
            <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>🚫 معطل</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> بحث</button>
        @if(request()->hasAny(['search','role','status']))
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> مسح</a>
        @endif
    </form>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus"></i> إضافة مستخدم
    </a>
</div>

<!-- Table -->
<div class="card">
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المستخدم</th>
                    <th>الهاتف</th>
                    <th>الدور</th>
                    <th>الحالة</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:var(--gray-400);font-size:.875rem">{{ $user->id }}</td>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm {{ $user->role === 'admin' ? 'admin' : '' }}">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $user->name }}</strong>
                                <span style="display:block;font-size:.8125rem;color:var(--gray-500)">{{ $user->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->phone ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-purple' : 'badge-blue' }}">
                            {{ $user->role === 'admin' ? '👑 مدير' : '👤 مستخدم' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $user->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $user->is_active ? '✅ نشط' : '🚫 معطل' }}
                        </span>
                    </td>
                    <td style="color:var(--gray-500);font-size:.875rem">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm" title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Toggle Status -->
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" style="display:inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-warning' : 'btn-success' }}"
                                    title="{{ $user->is_active ? 'تعطيل' : 'تفعيل' }}"
                                    data-confirm="{{ $user->is_active ? 'هل تريد تعطيل هذا المستخدم؟' : 'هل تريد تفعيل هذا المستخدم؟' }}">
                                    <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                </button>
                            </form>
                            <!-- Delete -->
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="حذف"
                                    data-confirm="هل أنت متأكد من حذف هذا المستخدم؟">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <p>لا يوجد مستخدمون</p>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">إضافة مستخدم</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div style="padding:1.5rem;border-top:1px solid var(--gray-200)">
        {{ $users->withQueryString()->links('admin.pagination') }}
    </div>
    @endif
</div>

@endsection

@push('styles')
<style>
.toolbar { display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:1.5rem; flex-wrap:wrap; }
.toolbar-search { display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; flex:1; }
.search-box { position:relative; flex:1; min-width:220px; }
.search-box i { position:absolute; right:1rem; top:50%; transform:translateY(-50%); color:var(--gray-400); }
.search-box input { width:100%; padding:.75rem 2.75rem .75rem 1.25rem; border:2px solid var(--gray-200); border-radius:var(--radius-md); font-family:inherit; font-size:.9375rem; transition:var(--transition); }
.search-box input:focus { outline:none; border-color:var(--primary-blue); box-shadow:0 0 0 4px rgba(0,86,210,.1); }

.user-cell { display:flex; align-items:center; gap:1rem; }

.user-avatar-sm {
    width: 42px; height: 42px;
    background: var(--secondary-blue);
    color: var(--primary-blue);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.125rem; font-weight: 700;
    flex-shrink: 0;
}

.user-avatar-sm.admin {
    background: #E9D5FF;
    color: #9333EA;
}

.btn-warning { background: var(--warning); color: var(--white); }
.btn-warning:hover { background: #D97706; }

.empty-state { text-align:center; padding:3rem; color:var(--gray-400); }
.empty-state i { font-size:3rem; margin-bottom:1rem; display:block; }
</style>
@endpush
