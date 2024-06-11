<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        @csrf
        <x-forms.input label="Name" name="name"/>
        <x-forms.input label="Email" name="email" type="email"/>
        <x-forms.input label="Password" name="password" type="password"/>
        <x-forms.input label="Password confirmation" name="password confirmation" type="password"/>
        <x-forms.input name="profile image" label="Profile image" type="file"/>

        {{-- <x-forms.divider/>

        <x-forms.input label="Employer name" name="employer"/>
        <x-forms.input label="Employer logo" name="logo" type="file"/> --}}

        <x-forms.button>Create account</x-forms.button>
    </x-forms.form>
</x-layout>