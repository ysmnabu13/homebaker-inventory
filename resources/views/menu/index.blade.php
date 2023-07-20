<x-layout>
    <form action="menu/search" method="GET">
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>
            <input type="text" name="query" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search Menu..."/>
            <div class="absolute top-2 right-2">
                <button type="submit" class="h-10 w-20 text-white rounded-lg" style="background-color: #506050;">
                    Search
                </button>
            </div>
        </div>
    </form>

    @auth
    <form action="menu/create">
        <button type="submit" class="mb-5 ml-5 p-5 h-10 w-50 text-white rounded-lg" style="background-color: #506050; display: flex; align-items: center; justify-content: center;">
            Add New Menu
        </button>
    </form>
    @endauth

    <div class="lg:grid lg:grid-cols-4 gap-10 space-y-4 md:space-y-0 mx-4">
        @foreach($menu as $menus)
           <x-menu-card :menu="$menus"/>
        @endforeach
    </div>

    <div class="p-5"> {{ $menu->links() }} </div>
</x-layout>