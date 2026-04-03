<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-6xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Roles & Permissions Management</h1>
            </div>

            <div
                class="text-xs bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 px-4 py-2 rounded-xl border border-amber-100 dark:border-amber-800">
                <i class="fas fa-shield-halved mr-2"></i>
                Security Dashboard (RBAC)
            </div>
        </div>

        {{-- Table Section --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                User</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Roles</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Direct Permissions</th>
                            <th
                                class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors"
                                x-data="{ openEdit: false }">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center text-white text-2xl font-black shadow-lg ring-4 ring-white dark:ring-gray-700 overflow-hidden">



                                            @if ($user->employee)
                                                {{-- 2. Check if the employee has a profile photo --}}
                                                @if ($user->employee->hasMedia('employee_profile_photos'))
                                                    <img src="{{ $user->employee->getFirstMediaUrl('employee_profile_photos') }}"
                                                        alt="{{ $user->name }}" class="h-full w-full object-cover">
                                                @else
                                                    {{-- 3. Display first letter of first_name --}}
                                                    <span class="">
                                                        {{ substr($user->employee->first_name, 0, 1) }}
                                                    </span>
                                                @endif
                                            @else
                                                {{-- 4. Fallback if the user has no employee record (e.g. System Admin) --}}
                                                <span >
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            @endif


                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $user->name }}</p>
                                            <p class="text-[11px] text-gray-500 font-mono italic">{{ $user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($user->roles as $role)
                                            <span
                                                class="px-2 py-0.5 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-md text-[10px] font-bold border border-emerald-100 dark:border-emerald-900/30">
                                                {{ $role->name }}
                                            </span>
                                        @empty
                                            <span class="text-[10px] text-gray-400 italic">No Roles Assigned</span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($user->permissions as $permission)
                                            <span
                                                class="px-2 py-0.5 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-md text-[10px] font-bold border border-blue-100 dark:border-blue-900/30">
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="text-[10px] text-gray-400 italic">No Direct Permissions</span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center">
                                        <button @click="openEdit = true"
                                            class="p-2 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all"
                                            title="Edit Access">
                                            <i class="fa-solid fa-user-shield text-lg"></i>
                                        </button>
                                    </div>

                                    {{-- Edit Modal --}}
                                    <div x-show="openEdit"
                                        class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto"
                                        x-cloak>
                                        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
                                            @click="openEdit = false"></div>

                                        <div
                                            class="relative bg-white dark:bg-[#161923] rounded-3xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden border border-gray-100 dark:border-white/5">
                                            <form action="{{ route('admin.sync-access', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="p-8 text-left">
                                                    <div class="flex items-center justify-between mb-6">
                                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                                            Edit Permissions: {{ $user->name }}</h3>
                                                        <button type="button" @click="openEdit = false"
                                                            class="text-gray-400 hover:text-gray-600"><i
                                                                class="fas fa-times"></i></button>
                                                    </div>

                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                                        {{-- Roles Section --}}
                                                        <div>
                                                            <label
                                                                class="text-xs font-black uppercase text-indigo-500 mb-3 block italic tracking-widest">
                                                                Roles</label>
                                                            <div
                                                                class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                                                @foreach ($roles as $role)
                                                                    <label
                                                                        class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-transparent hover:border-indigo-500 cursor-pointer transition-all">
                                                                        <span
                                                                            class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                                                                        <input type="checkbox" name="roles[]"
                                                                            value="{{ $role->name }}"
                                                                            {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                                                            class="rounded text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        {{-- Permissions Section --}}
                                                        <div>
                                                            <label
                                                                class="text-xs font-black uppercase text-emerald-500 mb-3 block italic tracking-widest">
                                                                Direct Permissions</label>
                                                            <div
                                                                class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                                                @foreach ($permissions as $permission)
                                                                    <label
                                                                        class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-transparent hover:border-emerald-500 cursor-pointer transition-all">
                                                                        <span
                                                                            class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                                                                        <input type="checkbox" name="permissions[]"
                                                                            value="{{ $permission->name }}"
                                                                            {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}
                                                                            class="rounded text-emerald-600 focus:ring-emerald-500 border-gray-300">
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="bg-gray-50 dark:bg-white/5 px-8 py-4 flex justify-end gap-3 border-t border-gray-100 dark:border-white/5">
                                                    <button type="button" @click="openEdit = false"
                                                        class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-all">Cancel</button>
                                                    <button type="submit"
                                                        class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic text-sm">
                                    No users found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
