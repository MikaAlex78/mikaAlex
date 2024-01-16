<!-- edit personel informations -->
<div id="editPersonnelModal" class="modal fade" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary bg-gradient text-white">
                <h5 class="modal-title">Edit employee</h5>
                <button type="button" class="btn-close btn-close-white closeModelBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPersonnelForm" class="adddata" action="insertPerson.php" method="post">
                    <input type="hidden" id="editPersonnelEmployeeID" name="id">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="firstName" id="editPersonnelFirstName" placeholder="First name" required>
                        <label for="editPersonnelFirstName">First name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editPersonnelLastName" name="lastName" placeholder="Last name" required>
                        <label for="editPersonnelLastName">Last name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editPersonnelJobTitle" name="jobTitle" placeholder="Job title" required>
                        <label for="editPersonnelJobTitle">Job Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="editPersonnelEmailAddress" name="email" placeholder="Email address" required>
                        <label for="editPersonnelEmailAddress">Email Address</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="editPersonnelDepartment"  name="departmentID"placeholder="Department">
                        </select>
                        <label for="editPersonnelDepartment">Department</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm myBtn closeModelBtn" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" form="editPersonnelForm" class="btn btn-outline-primary btn-sm myBtn">SAVE</button>
            </div>
        </div>
    </div>
</div>

<!-- edit deparment informations -->
<div id="editDepartmentModal" class="modal fade" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="editDepartmentModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary bg-gradient text-white">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDepartmentForm" class="adddata" action="insertDepartment.php" method="post">
                    <input type="hidden" id="editDepartmentId" name="id">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="editDepartmentName" placeholder="deparment name" required>
                        <label for="editDepartmentName">Department name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="locationID" id="editDepartmentLocation" placeholder="Department">
                        </select>
                        <label for="editDepartmentLocation">Location</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm myBtn closeModelBtn" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" form="editDepartmentForm" class="btn btn-outline-primary btn-sm myBtn">SAVE</button>
            </div>
        </div>
    </div>
</div>

<!-- edit location informations -->
<div id="editLocationModal" class="modal fade" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="editLocationModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary bg-gradient text-white">
                <h5 class="modal-title">Edit Location</h5>
                <button type="button" class="btn-close btn-close-white closeModelBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLocationForm" class="adddata" action="insertLocation.php" method="post">
                    <input type="hidden" id="editLocationId" name="id">
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" id="editLocationName" name="name" placeholder="location name" required>
                        <label for="editLocationName">Location name</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm myBtn closeModelBtn" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" form="editLocationForm" class="btn btn-outline-primary btn-sm myBtn">SAVE</button>
            </div>
        </div>
    </div>
</div>