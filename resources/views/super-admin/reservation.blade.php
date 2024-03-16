@extends('layout/layout')

@section('space-work')
<div class="pagetitle">
 
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card" style="border-radius:10px">
        <div class="card-body">
          <h5 class="card-title">Today's Appointments</h5>
 <!-- Large Modal -->
 
 <hr>


          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
              <th>Doctor's Name</th>
              <th>Patients's Name</th>
              <th>Appointment Date</th>
              <th>Action</th>

              </tr> 
            </thead>
            <tbody>
             
            @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        


                        

                        <td class="action-buttons">
                              <!-- Basic Modal -->
              <button type="button" class="btn btn-outline-warning elevation-3" data-bs-toggle="modal" data-bs-target="#basicModal{{ $appointment->id }}" >
                View details
              </button>
              <div class="modal fade" id="basicModal{{ $appointment->id }}" tabindex="-1" >
                <div class="modal-dialog" >
                  <div class="modal-content" style="width:700px" >
                    <div class="modal-header  text-center " style="background:blue;">
                      <h5 class="modal-title" style="color:white">Appointments' Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                   <div class="modal-body">
                      <div class="row">
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-user"></i>Doctor's Name:</strong>{{ $appointment->doctor->name }}</p>
                          </div>
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-envelope"></i>Patient's Name:</strong>{{ $appointment->patient->name }}</p>
                          </div>
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-envelope"></i>Appointment Date:</strong>{{ $appointment->appointment_date }}</p>
                          </div>
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-envelope"></i>Reason:</strong>{{ $appointment->notes }}</p>
                          </div>
                          <div class="col-md-6">
                              <p><strong><i class="fas fa-envelope"></i>Status:</strong>{{ $appointment->status }}</p>
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
                            <button type="button" class="btn btn-outline-primary elevation-3" data-toggle="modal" data-target="#editUserModal{{ $appointment->id }}">
                                <i class="fas fa-edit"></i> Edit 
                            </button>
                          

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