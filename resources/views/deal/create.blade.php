@extends('layouts.app')

@section('title', 'Create Deal')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Create Deal</h2>
        </div>
        
        <div class="p-6">
            <div id="alert-placeholder"></div>

            <form id="dealForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32" placeholder="Enter deal description..."></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                    <input type="number" name="discount" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0" max="100" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business</label>
                    <select name="business_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" required>
                        <option value="" disabled selected>Select a business</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" required>
                        <option value="" disabled selected>Select a category</option>
                    </select>
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        Create Deal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Populate business & category dropdowns
    window.onload = () => {
        fetch("/api/businesses")
            .then(res => res.json())
            .then(businesses => {
                const businessSelect = document.querySelector('select[name="business_id"]');
                businesses.forEach(b => {
                    businessSelect.innerHTML += `<option value="${b.id}">${b.name}</option>`;
                });
            });

        fetch("/api/categories")
            .then(res => res.json())
            .then(categories => {
                const categorySelect = document.querySelector('select[name="category_id"]');
                categories.forEach(c => {
                    categorySelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                });
            });
    };

    // Handle form submission
    document.getElementById('dealForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const data = {
            title: form.title.value,
            description: form.description.value,
            discount: parseFloat(form.discount.value),
            business_id: form.business_id.value,
            category_id: form.category_id.value
        };

        fetch("/api/deals", {
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
                    html = `<div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                              <div class="font-medium">Please fix the following errors:</div>
                              <ul class="mt-1 ml-5 list-disc">`;
                    for (let key in res.errors) {
                        html += `<li>${res.errors[key]}</li>`;
                    }
                    html += `</ul></div>`;
                } else {
                    html = `<div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                              Deal Created Successfully!
                            </div>`;
                    form.reset();
                }
                document.getElementById('alert-placeholder').innerHTML = html;
                
                // Scroll to the top of the form to see the alert
                document.getElementById('alert-placeholder').scrollIntoView({ behavior: 'smooth' });
            })
            .catch(err => {
                console.error(err);
                document.getElementById('alert-placeholder').innerHTML = `
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        An error occurred. Please try again.
                    </div>`;
            });
    });
</script>
@endsection