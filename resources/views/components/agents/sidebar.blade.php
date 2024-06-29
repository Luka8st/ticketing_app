<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-0 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 mt-2 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('agent.homepage') }}"
                    class="flex items-center p-2 h-12 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.2501 10H23.7501M11.2501 15H23.7501M11.2501 20H23.7501M6.2376 10H6.2501M6.2251 15H6.2376M6.2376 20H6.2501"
                            stroke="#383838" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">My open tickets</span>
                    <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $openTicketsCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('agent.tickets.indexNew') }}"
                    class="flex items-center p-2 h-12 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M12 19L12 5" stroke="#383838" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">New tickets</span>
                    <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $newTicketsCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('agent.tickets.indexClosed') }}"
                    class="flex items-center p-2 h-12 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.625 14.375L13.75 17.5L18.75 12.5M26.25 15C26.25 21.2132 21.2132 26.25 15 26.25C8.7868 26.25 3.75 21.2132 3.75 15C3.75 8.7868 8.7868 3.75 15 3.75C21.2132 3.75 26.25 8.7868 26.25 15Z"
                            stroke="#383838" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">My closed tickets</span>
                    <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $closedTicketsCount }}</span>
                </a>
            </li>
            <li class="fixed bottom-2 w-full">
                <hr class="border-t-2">
                <div class="mt-2 flex items-center">
                    <img src={{ asset(Auth::user()->image_path) }} alt="" class="w-12 h-12 rounded-full" />
                    <span>
                     {{ Auth::user()->name }}
                     <br>
                     <span class="text-xs italic">{{ Auth::user()->email }}</span>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</aside>
