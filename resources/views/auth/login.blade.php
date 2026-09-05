<x-layout title="Login">
    <x-slot:heading>Login</x-slot:heading>
    <div class="flex justify-center items-center h-full">
        <form action="/login" method="POST" class="flex flex-col gap-3 w-md mt-10 border rounded-xl border-white/10  p-4">
            @csrf

            <h1 class=" text-white">Login</h1>

            <div class="flex flex-col gap-0.5">
                <label for="email" class="label">Email</label>
                <input name="email" class="bg-transparent border border-white/10 p-2 rounded-lg outline-0" required
                    type="email" class="input" placeholder="Email" />
                <x-forms.error name="email" />
            </div>

            <div class="flex flex-col gap-0.5">
                <label for="password" class="label">Password</label>
                <input name="password" class="bg-transparent border border-white/10 p-2 rounded-lg outline-0" required
                    type="password" class="input" placeholder="Password" />
                <x-forms.error name="password" />
            </div>

            <button class="btn btn-primary mt-4">Register</button>
        </form>
    </div>
</x-layout>
