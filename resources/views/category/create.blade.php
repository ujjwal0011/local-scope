@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all">
        <!-- Decorative top pattern -->
        <div class="h-2 bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700"></div>
        
        <!-- Header with enhanced gradient background -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-800 px-8 py-5">
            <div class="flex items-center space-x-3">
                <i class="bi bi-grid-3x3-gap-fill text-2xl text-yellow-300"></i>
                <h2 class="text-2xl font-bold text-white tracking-wide">Create New Category</h2>
            </div>
            <p class="text-blue-100 mt-1 text-sm">Add a new category to organize deals</p>
        </div>
        
        <div class="p-8">
            <div id="alert-placeholder" class="mb-6"></div>

            <form id="categoryForm" class="space-y-6">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="bi bi-tag"></i>
                        </span>
                        <input type="text" name="name" placeholder="Enter category name..." 
                            class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200" 
                            required>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Choose a descriptive name for easy identification</p>
                </div>
                
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                    <textarea name="description" placeholder="Describe this category..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200 h-32"></textarea>
                </div>
                
                <div class="pt-6 flex items-center justify-between">
                    <a href="{{ route('categories.viewAll') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        <i class="bi bi-arrow-left mr-2"></i> Back to Categories
                    </a>
                    <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:-translate-y-0.5">
                        <span class="flex items-center">
                            <i class="bi bi-plus-circle mr-2"></i>
                            Create Category
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('categoryForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span class="flex items-center"><i class="bi bi-hourglass-split animate-spin mr-2"></i>Creating...</span>`;

        const form = e.target;
        const data = { 
            name: form.name.value,
            description: form.description ? form.description.value : ''
        };

        fetch("/api/categories", {
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
                    html = `<div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm animate-fadeIn" role="alert">
                              <div class="font-medium flex items-center">
                                <i class="bi bi-exclamation-triangle mr-2"></i>
                                Please fix the following errors:
                              </div>
                              <ul class="mt-2 ml-6 list-disc text-sm">`;
                    for (let key in res.errors) {
                        html += `<li class="mt-1">${res.errors[key]}</li>`;
                    }
                    html += `</ul></div>`;
                } else {
                    html = `<div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm animate-fadeIn">
                              <div class="flex items-center">
                                <i class="bi bi-check-circle-fill mr-2 text-green-600"></i>
                                <span>
                                  <span class="font-medium">Success!</span> Category has been created successfully.
                                </span>
                              </div>
                            </div>`;
                    form.reset();
                }
                document.getElementById('alert-placeholder').innerHTML = html;
                
                // Scroll to the top of the form to see the alert
                document.getElementById('alert-placeholder').scrollIntoView({ behavior: 'smooth' });
                
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            })
            .catch(err => {
                console.error(err);
                document.getElementById('alert-placeholder').innerHTML = `
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm animate-fadeIn">
                        <div class="flex items-center">
                            <i class="bi bi-x-circle-fill mr-2 text-red-600"></i>
                            <span>
                                <span class="font-medium">Error!</span> An unexpected error occurred. Please try again.
                            </span>
                        </div>
                    </div>`;
                
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
    });
</script>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection