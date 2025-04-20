@extends('layouts.app')

@section('title', 'Create Business')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header with gradient background -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-lg p-6 mb-8">
        <h1 class="text-2xl font-bold text-white">Create Business</h1>
        <p class="text-blue-100 mt-1">Add your business to our local directory</p>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div id="alert-placeholder" class="mb-6"></div>

            <form id="businessForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">User ID</label>
                    <input type="number" name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter business name" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32" placeholder="Describe your business..." required></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Full address" required>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <div class="relative">
                            <input type="text" name="latitude" id="latitude" class="w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-300 rounded-lg" readonly required>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <div class="relative">
                            <input type="text" name="longitude" id="longitude" class="w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-300 rounded-lg" readonly required>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Create Business
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Fetch geolocation
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
        document.getElementById('latitude').value = position.coords.latitude;
        document.getElementById('longitude').value = position.coords.longitude;
    }, error => {
        // Create a more styled alert
        document.getElementById('alert-placeholder').innerHTML = `
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">Geolocation error: ${error.message}</p>
                    </div>
                </div>
            </div>
        `;
    });
}

// Submit form via API
document.getElementById('businessForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;
    const data = {
        user_id: form.user_id.value,
        name: form.name.value,
        description: form.description.value,
        address: form.address.value,
        latitude: form.latitude.value,
        longitude: form.longitude.value
    };

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i> Submitting...`;
    submitBtn.disabled = true;

    fetch("/api/businesses", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
        let html = '';
        if (res.errors) {
            html = `<div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded">
                        <div class="font-medium">Please fix the following errors:</div>
                        <ul class="mt-1 ml-5 list-disc">`;
            for (let key in res.errors) {
                html += `<li>${res.errors[key]}</li>`;
            }
            html += `</ul></div>`;
        } else {
            html = `<div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Business Created Successfully!
                     </div>`;
            form.reset();
        }
        document.getElementById('alert-placeholder').innerHTML = html;
        
        // Restore button state
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
        
        // Scroll to the top of the form to see the alert
        document.getElementById('alert-placeholder').scrollIntoView({ behavior: 'smooth' });
    })
    .catch(err => {
        console.error("Error:", err);
        document.getElementById('alert-placeholder').innerHTML = `
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">An unexpected error occurred. Please try again.</p>
                    </div>
                </div>
            </div>
        `;
        
        // Restore button state
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    });
});
</script>
@endsection