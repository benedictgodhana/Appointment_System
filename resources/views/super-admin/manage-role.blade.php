@extends('layout/layout')

@section('space-work')
<div class="pagetitle">
 
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card" style="border-radius:10px">
        <div class="card-body">
          <h5 class="card-title">Role Management</h5>
 <!-- Large Modal -->
 
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
              <th>Name</th>
              <th>Email</th>              
              <th>Role</th>
            <th>Action</th>
              </tr> 
            </thead>
            <tbody>
             
            @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->name }}</td>

                        <td class="action-buttons">
                              <!-- Basic Modal -->
              <button type="button" class="btn btn-outline-warning elevation-3" data-bs-toggle="modal" data-bs-target="#basicModal{{ $user->id }}" >
                View details
              </button>
              <div class="modal fade" id="basicModal{{ $user->id }}" tabindex="-1" >
                <div class="modal-dialog" >
                  <div class="modal-content" >
                    <div class="modal-header  text-center  bg-primary">
                      <h5 class="modal-title" style="color:white">Doctor's Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                   <div class="modal-body">
                      <div class="row">
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-user"></i> Name:</strong> {{ $user->name }}</p>
                          </div>
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-envelope"></i> Email:</strong> {{ $user->email }}</p>
                          </div>
                                
                          
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-user-tag"></i> Role:</strong>
                                  @if ($user->roles == null)
                                      User
                                  @else
                                      {{ $user->roles->name }}
                                  @endif
                              </p>
                          </div>
                        
                              <!-- Add more doctor-specific information as needed -->
                      </div>
                  </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

            </div>
          </div>
                            <button type="button" class="btn btn-outline-primary elevation-3" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                <i class="fas fa-edit"></i> Edit User
                            </button>
                            @if($user->activated)
                            <button style="width:120px" type="button" class="btn btn-outline-danger btn-sm elevation-3" data-toggle="modal" data-target="#deactivateUserModal{{ $user->id }}">
                                <i class="fas fa-ban"></i> Deactivate
                            </button>
                            @else
                            <button style="width:120px" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#activateUserModal{{ $user->id }}">
                                <i class="fas fa-check-circle"></i> Activate
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var qualificationSelect = document.getElementById("qualification");
        var customQualificationField = document.getElementById("customQualificationField");
        var customQualificationInput = document.getElementById("custom_qualification");

        // Function to toggle the display of the custom qualification field
        function toggleCustomQualificationField() {
            customQualificationField.style.display = (qualificationSelect.value === "custom") ? "block" : "none";
        }

        // Initial toggle based on the default value
        toggleCustomQualificationField();

        // Event listener for changes in the qualification dropdown
        qualificationSelect.addEventListener("change", toggleCustomQualificationField);
    });
</script>


@endsection