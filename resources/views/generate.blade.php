<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Generation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10">
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded-xl">
    <h1 class="text-2xl font-bold mb-4 text-center">Generate 4 Blog Posts</h1>

      @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif
  @if (session('loading'))
            <div class="mb-4 p-4 bg-blue-100 border border-blue-300 text-blue-700 rounded">
                Please wait... your content is being generated.
            </div>
        @endif
    <form action="{{ route('generate.submit') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">3 Keywords</label>
            <input type="text" name="keywords" class="w-full border rounded p-2"
                   placeholder="Example: tourism, hotel, travel" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Tone</label>
            <select name="tone" class="w-full border rounded p-2" required>
                <option value="formal">Formal</option>
                <option value="friendly">Friendly</option>
                <option value="funny">Humorous</option>
                <option value="promo">Promotional</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Language</label>
            <select name="lang" class="w-full border rounded p-2" required>
                <option value="fa">Persian</option>
                <option value="en">English</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Campaign Goal</label>
            <textarea name="goal" class="w-full border rounded p-2" rows="2"
                      placeholder="Example: Increase winter hotel bookings"
                      required></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Personalization Level</label>
            <select name="personalization" class="w-full border rounded p-2" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <!-- Business Category -->
        <div>
            <label class="block font-semibold mb-1">Business Category</label>
            <select name="business_category" class="w-full border rounded p-2" required>
                <option value="restaurant">Restaurant</option>
                <option value="cafe">Cafe</option>
                <option value="barbershop">Barbershop</option>
                <option value="hotel">Hotel</option>
                <option value="clinic">Clinic</option>
                <option value="gym">Gym</option>
                <option value="store">Store</option>
                <option value="other">Other</option>
            </select>
        </div>

        <!-- Postal Code -->
        <div>
            <label class="block font-semibold mb-1">Postal Code</label>
            <input type="text" name="postal_code" class="w-full border rounded p-2"
                   placeholder="Example: 1234567890" required>
        </div>

        <!-- AI Provider -->
        <div>
            <label class="block font-semibold mb-1">AI Provider</label>
            <select name="ai_provider" class="form-control w-full border rounded p-2">
                <option value="gemini">Gemini</option>
                <option value="openai">OpenAI</option>
                <option value="claude">Claude</option>
            </select>
        </div>

        <button class="w-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700">
           Generate Content
        </button>
    </form>
</div>
</body>
</html>
