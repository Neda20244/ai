<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generating Content...</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        async function check() {
            const res = await fetch(`http://localhost:8002/api/posts/by-job/{{ $job_id }}`);
            console.log('res',res)
            const posts = await res.json();
            if (posts.length === 4) {
                window.location.href = `/generated-posts?job_id={{ $job_id }}`;
            }
        }

        setInterval(check, 3000); // check every 3 seconds
    </script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
<div class="bg-white shadow-xl p-10 rounded-2xl text-center">
    <h1 class="text-2xl font-bold mb-4">Generating your posts...</h1>
    <p class="text-gray-700">Please wait while we prepare your content.</p>

    <div class="mt-6 animate-pulse text-blue-600 font-semibold">
        Loading...
    </div>
</div>
</body>
</html>
