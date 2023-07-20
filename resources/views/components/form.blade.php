<link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
<style>
    h2{
        font-family: 'Abril Fatface';
        font-weight: bold;
        font-size: x-large;
        margin-bottom: 5%;
    }

    label{
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    select, input{
        display: inline-block;
        border-radius: 50px;
        background-color: white;
        border: 1px solid #CBD5E0;
        padding: 0.5rem;
        width: 100%;
    }

    a.account{
        font-weight: bold;
        color: gray;
    }

    a.account:hover{
        text-decoration: underline;
        color: #506050;
    }

    button.submit{
        background-color: #506050;
        color: white;
        border-radius: 0.25rem;
        padding: 0.5rem 1rem;
        transition: background-color 0.3s ease-in-out;
        cursor: pointer;
        margin-left: 1rem;
    }

    button.submit:hover{
        background-color: #889d88;
        color: white;
    }

</style>
<div class="bg-gray-50 border border-gray-200 rounded p-10 max-w-lg mx-auto">
    <main>
        {{ $slot }}
      </main>
</div>