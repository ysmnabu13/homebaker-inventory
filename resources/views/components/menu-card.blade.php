<style>
    @import url("https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css");
    @import url("https://fonts.googleapis.com/css2?family=Exo+2:wght@300;500;700&display=swap");

    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    ol {
        width: min(60rem, 90%);
        margin-inline: auto;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 2rem;
        list-style: none;
        color: white;
        background-color: #506050;
        border-radius: 0.375rem;
        padding: 1.5rem;
    }

    ol li {
        width: 18rem;
        --borderS: 2rem;
        aspect-ratio: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* padding-left: calc(var(--borderS) + 2rem); */
        position: relative;
        padding-left: auto;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    ol li::before,
    ol li::after {
        inset: 0;
        position: absolute;
        border-radius: 50%;
        border: var(--borderS) solid var(--bgColor);
        line-height: 1.1;
    }

    ol li > * { 
        text-align: center;
        width: 100%; /* Spread the content horizontally */
    }

    ol li .photo { 
        align-items: center; /* Center the photo vertically */
        flex-grow: 1; /* Make the photo take up more space */
        padding-left: calc(var(--borderS));
    }
    
    ol li .photo img { 
        max-width: 100%; /* Make the photo fill the available space */
        max-height: 100%; /* Make the photo fill the available space */
    }
    
    ol li .name { 
        font-size: 1.5rem; 
        font-weight: 300 
    }

    ol li .price { 
        font-size: 1rem; 
        font-weight: 300 
    }

    .button-container {
        margin-top: -2rem;
        margin-bottom: -2rem;
    }
</style>

<ol>
    <li>
        <div class="photo">
            <img class="hidden w-48 mr-6 md:block"
                src="{{ $menu->photo ? asset('storage/' . $menu->photo) : asset('/images/no-image.png') }}"/>
        </div>
        <div class="name">{{$menu->name}}</div>
        <div class="price">RM {{$menu->price}}</div>
    </li>

    @auth
    <a href="/recipe/{{ $menu->id }}">Recipe</a>|
    <a href="/cost/{{ $menu->id }}">Cost</a>

    <div class="flex justify-center space-x-4 my-1 button-container">
        <a href="/menu/{{ $menu->id }}/edit" class="btn-primary mr-4">Edit</a>
        <form method="POST" action="/menu/{{ $menu->id }}">|
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger ml-4">Delete</button>
        </form>
    </div>
    @endauth
</ol>
