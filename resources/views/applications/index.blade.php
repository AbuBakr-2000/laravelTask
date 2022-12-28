<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <span class="font-bold text-xl text-blue-500">{{ __('My Applications') }}</span>
                    <div class='mt-3'>

                        @foreach($applications as $application)

                            <div class="rounded-xl border p-5 mt-5 shadow-md w-9/12 bg-white">
                                <div class="flex w-full items-center justify-between border-b pb-3">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                                        <div
                                            class="text-lg font-bold text-slate-700">{{ $application->user->name }}</div>
                                    </div>
                                    <div class="flex items-center space-x-8">
                                        <button
                                            class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">
                                            # {{ $application->id }}
                                        </button>
                                        <div class="text-xs text-neutral-500">{{ $application->created_at }}</div>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <div class="mt-4 mb-3">
                                            <div class="mb-3 text-xl font-bold">
                                                {{ $application->subject }}
                                            </div>
                                            <div class="text-sm text-neutral-600">
                                                {{ $application->message }}
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between text-slate-500">
                                            {{ $application->user->email }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-center items-center">
                                        @if($application->file_url !== null)
                                            <div
                                                class="border m-6 p-6 rounded hover:bg-gray-100 transition cursor-pointer ">
                                                <a href="{{ asset('storage/' .$application->file_url) }}"
                                                   target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @else
                                            <div class="m-6 p-6">No file</div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        @endforeach
                        <div class="mt-4">
                            {{ $applications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>