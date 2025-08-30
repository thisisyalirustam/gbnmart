@extends('admin.layout.content')

@section('content')
    <div class="pagetitle">
        <h1>Website Settings Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Website Settings</li>
            </ol>
        </nav>
    </div>

    <style>
        /* Main Dashboard Styles */
        .settings-dashboard {
            padding: 20px;
        }
        
        /* Top Navigation Menu */
        .settings-menu {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            padding: 10px 15px;
        }
        
        .settings-menu ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            overflow-x: auto;
        }
        
        .settings-menu li {
            margin-right: 15px;
        }
        
        .settings-menu a {
            display: block;
            padding: 8px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .settings-menu a:hover,
        .settings-menu a.active {
            background-color: #f0f4ff;
            color: #4154f1;
        }
        
        .settings-menu a i {
            margin-right: 8px;
        }
        
        /* Settings Cards */
        .settings-card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 25px;
            border: none;
            overflow: hidden;
        }
        
        .settings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .settings-card .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .settings-card .card-header i {
            margin-right: 10px;
            font-size: 1.2rem;
            color: #4154f1;
        }
        
        .settings-card .card-body {
            padding: 20px;
        }
        
        /* Settings Groups */
        .settings-group {
            margin-bottom: 25px;
        }
        
        .settings-group-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #4154f1;
            display: flex;
            align-items: center;
        }
        
        .settings-group-title i {
            margin-right: 8px;
        }
        
        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .setting-item:last-child {
            border-bottom: none;
        }
        
        .setting-label {
            font-weight: 500;
            color: #555;
        }
        
        .setting-value {
            font-weight: 600;
            color: #333;
        }
        
        .setting-control {
            display: flex;
            align-items: center;
        }
        
        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: #4154f1;
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        /* Buttons */
        .btn-edit {
            background-color: transparent;
            border: 1px solid #ddd;
            color: #555;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }
        
        .btn-edit:hover {
            background-color: #f8f9fa;
            color: #4154f1;
            border-color: #4154f1;
        }
        
        /* Preview Section */
        .preview-section {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .preview-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .logo-preview {
            max-width: 200px;
            margin-bottom: 20px;
        }
        
        /* Role & Permissions Specific Styles */
        .permission-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
        }
        
        .permission-name {
            flex: 1;
            font-weight: 500;
        }
        
        .role-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 8px;
            background-color: #e9ecef;
            color: #495057;
        }
        
        /* Responsive Grid */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }
            
            .settings-menu ul {
                flex-wrap: wrap;
            }
            
            .settings-menu li {
                margin-bottom: 5px;
            }
        }
    </style>

    <section class="section settings-dashboard">
        <!-- Top Navigation Menu -->
        <div class="settings-menu">
            <ul>
                <li><a href="#general" class="active"><i class="fas fa-cog"></i> General</a></li>
                <li><a href="#appearance"><i class="fas fa-paint-brush"></i> Appearance</a></li>
                <li><a href="#social"><i class="fas fa-share-alt"></i> Social Media</a></li>
                <li><a href="#seo"><i class="fas fa-search"></i> SEO</a></li>
                <li><a href="#roles"><i class="fas fa-user-shield"></i> Roles & Permissions</a></li>
                <li><a href="#maintenance"><i class="fas fa-tools"></i> Maintenance</a></li>
                <li><a href="#advanced"><i class="fas fa-sliders-h"></i> Advanced</a></li>
            </ul>
        </div>

        <div class="settings-grid">
            <!-- General Settings Card -->
            <div class="card settings-card">
                <div class="card-header">
                    <i class="fas fa-cog"></i>
                    <span>General Settings</span>
                </div>
                <div class="card-body">
                    <div class="settings-group">
                        <div class="settings-group-title">
                            <i class="fas fa-info-circle"></i>
                            <span>Basic Information</span>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Website Name</div>
                                <div class="setting-value">My Awesome Site</div>
                            </div>
                            <button class="btn-edit">Edit</button>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Website Description</div>
                                <div class="setting-value">Premium content for our community</div>
                            </div>
                            <button class="btn-edit">Edit</button>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <div class="settings-group-title">
                            <i class="fas fa-language"></i>
                            <span>Language & Region</span>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Default Language</div>
                                <div class="setting-value">English</div>
                            </div>
                            <button class="btn-edit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Appearance Settings Card -->
            <div class="card settings-card">
                <div class="card-header">
                    <i class="fas fa-paint-brush"></i>
                    <span>Appearance</span>
                </div>
                <div class="card-body">
                    <div class="settings-group">
                        <div class="settings-group-title">
                            <i class="fas fa-palette"></i>
                            <span>Theme & Colors</span>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Primary Color</div>
                                <div class="setting-value">#4154f1</div>
                            </div>
                            <button class="btn-edit">Change</button>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <div class="settings-group-title">
                            <i class="fas fa-image"></i>
                            <span>Branding</span>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Logo</div>
                                <div class="setting-value">logo.png</div>
                            </div>
                            <button class="btn-edit">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Roles & Permissions Card -->
            <div class="card settings-card">
                <div class="card-header">
                    <i class="fas fa-user-shield"></i>
                    <span>Roles & Permissions</span>
                </div>
                <div class="card-body">
                    <div class="settings-group">
                        <div class="settings-group-title">
                            <i class="fas fa-users"></i>
                            <span>Roles $ Permessions Managment</span>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Permessions</div>
                                <div class="setting-value">Add Permessions</div>
                            </div>
                            <a href="{{route('admin.settings.permissions.page')}}" class="btn-edit">Manage</a>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Role</div>
                                <div class="setting-value">Add Roles</div>
                            </div>
                            <a href="{{route('role.index')}}" class="btn-edit">Manage</a>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Assign </div>
                                <div class="setting-value">Role $ Permessions</div>
                            </div>
                            <a href="{{route('admin.settings.roleandpermession')}}" class="btn-edit">Manage</a>
                        </div>
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">All</div>
                                <div class="setting-value">Role & Permessions</div>
                            </div>
                            <a href="{{route('admin.settings.allpermession')}}" class="btn-edit">Manage</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Social Media Settings Card -->
            <div class="card settings-card">
                <div class="card-header">
                    <i class="fas fa-share-alt"></i>
                    <span>Social Media</span>
                </div>
                <div class="card-body">
                    <div class="settings-group">
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Facebook</div>
                                <div class="setting-value">https://facebook.com/mywebsite</div>
                            </div>
                            <button class="btn-edit">Edit</button>
                        </div>
                        
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Twitter</div>
                                <div class="setting-value">https://twitter.com/mywebsite</div>
                            </div>
                            <button class="btn-edit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- SEO Settings Card -->
            <div class="card settings-card">
                <div class="card-header">
                    <i class="fas fa-search"></i>
                    <span>SEO Settings</span>
                </div>
                <div class="card-body">
                    <div class="settings-group">
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Meta Title</div>
                                <div class="setting-value">My Awesome Website</div>
                            </div>
                            <button class="btn-edit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Maintenance Settings Card -->
            <div class="card settings-card">
                <div class="card-header">
                    <i class="fas fa-tools"></i>
                    <span>Maintenance</span>
                </div>
                <div class="card-body">
                    <div class="settings-group">
                        <div class="setting-item">
                            <div>
                                <div class="setting-label">Maintenance Mode</div>
                                <div class="setting-value">Disabled</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Structure (hidden by default) -->
    <div class="modal fade" id="settingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="settingName" class="form-label">Setting Name</label>
                            <input type="text" class="form-control" id="settingName">
                        </div>
                        <div class="mb-3">
                            <label for="settingValue" class="form-label">Value</label>
                            <input type="text" class="form-control" id="settingValue">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle top menu navigation
        document.querySelectorAll('.settings-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links
                document.querySelectorAll('.settings-menu a').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // In a real implementation, this would load the corresponding section
                console.log('Navigating to:', this.getAttribute('href'));
            });
        });
        
        // Handle edit button clicks
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                console.log('Edit button clicked for:', 
                    this.closest('.setting-item').querySelector('.setting-label').textContent);
                
                // Example of showing a modal
                // $('#settingModal').modal('show');
            });
        });
        
        // Toggle switch functionality
        document.querySelectorAll('.toggle-switch input').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const settingItem = this.closest('.setting-item');
                const valueDisplay = settingItem.querySelector('.setting-value');
                
                if(this.checked) {
                    valueDisplay.textContent = 'Enabled';
                } else {
                    valueDisplay.textContent = 'Disabled';
                }
            });
        });
    </script>
@endsection