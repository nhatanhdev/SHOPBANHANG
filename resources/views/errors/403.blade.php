@extends('layouts.home')
@section('title')
    <title>403</title>
@endsection
@section('css')
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {
                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 20 14.3% 4.1%;
                --card: 0 0% 100%;
                --card-foreground: 20 14.3% 4.1%;
                --popover: 0 0% 100%;
                --popover-foreground: 20 14.3% 4.1%;
                --primary: 47.9 95.8% 53.1%;
                --primary-foreground: 26 83.3% 14.1%;
                --secondary: 60 4.8% 95.9%;
                --secondary-foreground: 24 9.8% 10%;
                --muted: 60 4.8% 95.9%;
                --muted-foreground: 25 5.3% 44.7%;
                --accent: 60 4.8% 95.9%;
                --accent-foreground: 24 9.8% 10%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 60 9.1% 97.8%;
                --border: 20 5.9% 90%;
                --input: 20 5.9% 90%;
                --ring: 20 14.3% 4.1%;
                --radius: 0.95rem;
            }

            .dark {
                --background: 20 14.3% 4.1%;
                --foreground: 60 9.1% 97.8%;
                --card: 20 14.3% 4.1%;
                --card-foreground: 60 9.1% 97.8%;
                --popover: 20 14.3% 4.1%;
                --popover-foreground: 60 9.1% 97.8%;
                --primary: 47.9 95.8% 53.1%;
                --primary-foreground: 26 83.3% 14.1%;
                --secondary: 12 6.5% 15.1%;
                --secondary-foreground: 60 9.1% 97.8%;
                --muted: 12 6.5% 15.1%;
                --muted-foreground: 24 5.4% 63.9%;
                --accent: 12 6.5% 15.1%;
                --accent-foreground: 60 9.1% 97.8%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 60 9.1% 97.8%;
                --border: 12 6.5% 15.1%;
                --input: 12 6.5% 15.1%;
                --ring: 35.5 91.7% 32.9%;
            }
        }
    </style>
    <style>
        .login-out a {
            color: black
        }
    </style>
@endsection
@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 text-white">
        <h1 class="text-9xl font-bold relative">
            403
        </h1>
        <p class="text-2xl mt-4">YOU HAVE NOT PEMISSION </p>
        <a href="/"
            class="mt-8 px-6 py-2 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition-colors duration-300">HOME</a>
    </div>
@endsection
