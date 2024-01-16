$(document).ready(function () {

    $("#searchInp").on("input", function () {
        let inputString = $("#searchInp").val().toLowerCase();
        $(".table-row").hide();

        if ($("#personnelBtn").hasClass("active")) {
            $("#personal_data .table-row").filter(function () {
                let tdContents = $(this).find('td').map(function () {
                    return $(this).text().toLowerCase();
                }).get();
                return tdContents.some(function (content) {
                    return content.includes(inputString);
                });
            }).show();
        } else if ($("#departmentsBtn").hasClass("active")) {
            $("#deparments_data .table-row").filter(function () {
                let firstTdContent = $(this).find('td:first').text().toLowerCase();
                if (firstTdContent.includes(inputString)) {
                    return true;
                }
                let secondTdContent = $(this).find('td:nth-child(2)').text().toLowerCase();
                return secondTdContent.includes(inputString);
            }).show();
        } else {
            $("#locations_data .table-row").filter(function () {
                return $(this).find('td:first').text().toLowerCase().includes(inputString);
            }).show();
        }
    });


    $("#filterBtn").click(function () {

        // Open a modal of your own design that allows the user to apply a filter to the personnel table on either department or location

    });

    $("#refreshBtn").click(function () {
        if ($("#personnelBtn").hasClass("active")) {
            load_personalTable();
        } else {
            if ($("#departmentsBtn").hasClass("active")) {
                load_deparmentTable();
            } else {
                load_locationTable();
            }
        }
    });

    $("#addBtn").click(function () {
        if ($("#personnelBtn").hasClass("active")) {
            $("#editPersonnelForm")[0].reset();
            $('#editPersonnelEmployeeID').val('');
            getAllDepartments('editPersonnelDepartment')
            $("#editPersonnelModal .modal-title").text('Add Person');
            $("#editPersonnelModal").modal('show');
        } else {
            if ($("#departmentsBtn").hasClass("active")) {
                $("#editDepartmentForm")[0].reset();
                $('#editDepartmentId').val('');
                getAllLocations('editDepartmentLocation');
                $("#editDepartmentModal .modal-title").text('Add Department');
                $("#editDepartmentModal").modal('show');
            } else {
                $("#editLocationForm")[0].reset();
                $('#editLocationId').val('');
                $("#editLocationModal .modal-title").text('Add Location');
                $("#editLocationModal").modal('show');
            }
        }
    });

    $("#personnelBtn").click(function () {
        load_personalTable();// Call function to refresh personnel table
    });

    $("#departmentsBtn").click(function () {
        load_deparmentTable(); // Call function to refresh department table
    });

    $("#locationsBtn").click(function () {
        load_locationTable();        // Call function to refresh location table
    });

    // edit personal informations...
    $("#editPersonnelModal").on("show.bs.modal", function (e) {
        let rowId = $(e.relatedTarget).data("id") ?? '';
        if (rowId) {
            $("#editPersonnelModal .modal-title").text('Edit Person');
            $.ajax({
                url:
                    "getPersonnelByID.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: $(e.relatedTarget).attr("data-id")
                },
                success: function (result) {
                    var resultCode = result.status.code;

                    if (resultCode == 200) {
                        // Update the hidden input with the employee id so that
                        // it can be referenced when the form is submitted
                        $("#editPersonnelEmployeeID").val(result.data.personnel[0].id);
                        $("#editPersonnelFirstName").val(result.data.personnel[0].firstName);
                        $("#editPersonnelLastName").val(result.data.personnel[0].lastName);
                        $("#editPersonnelJobTitle").val(result.data.personnel[0].jobTitle);
                        $("#editPersonnelEmailAddress").val(result.data.personnel[0].email);
                        $("#editPersonnelDepartment").html("");

                        $.each(result.data.department, function () {
                            $("#editPersonnelDepartment").append(
                                $("<option>", {
                                    value: this.id,
                                    text: this.name
                                })
                            );
                        });

                        $("#editPersonnelDepartment").val(result.data.personnel[0].departmentID);

                    } else {
                        $("#editPersonnelModal .modal-title").replaceWith(
                            "Error retrieving data"
                        );
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#editPersonnelModal .modal-title").replaceWith(
                        "Error retrieving data"
                    );
                }
            });
        }
    });

    // delete personal informations...
    $(document).on('click', '.deletePersonnelBtn', function (e) {
        var rowToDelete = $(this).closest('tr');
        $.ajax({
            url: "deletePersonnelByID.php",
            type: "POST",
            dataType: "json",
            data: {
                id: $(this).data("id")
            },
            success: function (result) {
                var resultCode = result.status.code;
                if (resultCode == 200) {
                    rowToDelete.fadeOut(500, function () {
                        $(this).remove();  // Remove the row
                    })
                } else {
                    alert('Record is not deleted');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Record is not deleted');
            }
        });
    });

    // edit deparment informations...
    $("#editDepartmentModal").on("show.bs.modal", function (e) {
        let rowId = $(e.relatedTarget).data("id") ?? '';
        if (rowId) {
            $("#editDepartmentModal .modal-title").text('Edit Department');
            $.ajax({
                url:
                    "getDepartmentByID.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: $(e.relatedTarget).attr("data-id")
                },
                success: function (result) {
                    var resultCode = result.status.code;

                    if (resultCode == 200) {
                        console.log(result);
                        // Update the hidden input with the employee id so that
                        // it can be referenced when the form is submitted
                        $("#editDepartmentId").val(result.data.id);
                        $("#editDepartmentName").val(result.data.name);
                        $("#editDepartmentLocation").html("");

                        $.each(result.data.location, function () {
                            $("#editDepartmentLocation").append(
                                $("<option>", {
                                    value: this.id,
                                    text: this.name
                                })
                            );
                        });

                        $("#editDepartmentLocation").val(result.data.locationID);

                    } else {
                        $("#editDepartmentModal .modal-title").replaceWith(
                            "Error retrieving data"
                        );
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#editDepartmentModal .modal-title").replaceWith(
                        "Error retrieving data"
                    );
                }
            });
        }
    });

    // delete Department informations...
    $(document).on('click', '.deleteDepartmentBtn', function (e) {
        var rowToDelete = $(this).closest('tr');
        $.ajax({
            url: "deleteDepartmentByID.php",
            type: "POST",
            dataType: "json",
            data: {
                id: $(this).data("id")
            },
            success: function (result) {
                var resultCode = result.status.code;
                if (resultCode == 200) {
                    rowToDelete.fadeOut(500, function () {
                        $(this).remove();  // Remove the row
                    })
                }
                else if (resultCode == 500) {
                    alert(result.status.description);
                }
                else {
                    alert('Deparment is not deleted');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Deparment is not deleted');
            }
        });
    });

    // edit location informations...
    $("#editLocationModal").on("show.bs.modal", function (e) {
        let rowId = $(e.relatedTarget).data("id") ?? '';
        if (rowId) {
            $("#editLocationModal .modal-title").text('Edit Location');
            $.ajax({
                url:
                    "getLocationByID.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: $(e.relatedTarget).attr("data-id")
                },
                success: function (result) {
                    var resultCode = result.status.code;

                    if (resultCode == 200) {
                        console.log(result);
                        $("#editLocationId").val(result.data.id);
                        $("#editLocationName").val(result.data.name);
                    } else {
                        $("#editLocationModal .modal-title").replaceWith(
                            "Error retrieving data"
                        );
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#editLocationModal .modal-title").replaceWith(
                        "Error retrieving data"
                    );
                }
            });
        }
    });

    // delete Location informations...
    $(document).on('click', '.deleteLocationBtn', function (e) {
        var rowToDelete = $(this).closest('tr');
        $.ajax({
            url: "deleteLocationByID.php",
            type: "POST",
            dataType: "json",
            data: {
                id: $(this).data("id")
            },
            success: function (result) {
                var resultCode = result.status.code;
                if (resultCode == 200) {
                    rowToDelete.fadeOut(500, function () {
                        $(this).remove();  // Remove the row
                    })
                }
                else if (resultCode == 500) {
                    alert(result.status.description);
                }
                else {
                    alert('Location is not deleted');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Location is not deleted');
            }
        });
    });

    // save and update  informations ...
    $(".adddata").on("submit", function (e) {
        e.preventDefault();
        var url_name = $(this).attr('action');
        var form_method = $(this).attr('method');
        var formData = $(this).serialize();
        $.ajax({
            url: url_name,
            type: form_method,
            dataType: 'json',
            data: formData,
            success: function (response) {

                let resultCode = response.status.code;
                let resultName = response.status.name;
                let resultDesc = response.status.description;
                if (resultCode == 200) {
                    $('.closeModelBtn').trigger('click');
                    if (resultName == 'person') {
                        load_personalTable();
                    }
                    else if (resultName == 'department') {
                        load_deparmentTable();
                    }
                    else if (resultName == 'location') {
                        load_locationTable();
                    }
                } else {
                    console.error('No data received or invalid response structure');
                    alert('No data received or invalid response structure');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    });

    function load_personalTable() {
        // Make AJAX request to getAll.php
        $.ajax({
            url: 'getAll.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var htmlString = '';

                // Check if the response has data
                if (response && response.data) {
                    // Loop through the data and construct the HTML string
                    $.each(response.data, function (index, person) {
                        htmlString += '<tr class="table-row">' +
                            '<td class="align-middle text-nowrap">' + person.firstName + ', ' + person.lastName + '</td>' +
                            '<td class="align-middle text-nowrap d-none d-md-table-cell">' + person.department + '</td>' +
                            '<td class="align-middle text-nowrap d-none d-md-table-cell">' + person.location + '</td>' +
                            '<td class="align-middle text-nowrap d-none d-md-table-cell">' + person.email + '</td>' +
                            '<td class="text-end text-nowrap">' +
                            '<button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editPersonnelModal" data-id="' + person.id + '">' +
                            '<i class="fa-solid fa-pencil fa-fw"></i>' +
                            '</button>' +
                            '<button type="button" class="btn btn-primary btn-sm deletePersonnelBtn m-2" data-id="' + person.id + '">' +
                            '<i class="fa-solid fa-trash fa-fw"></i>' +
                            '</button>' +
                            '</td>' +
                            '</tr>';
                    });

                    // Append the constructed HTML string to the tbody
                    $('#personal_data').html(htmlString);

                    // alert('Data personal appended successfully!');
                } else {
                    console.error('No data received or invalid response structure');
                    alert('No data received or invalid response structure');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function load_deparmentTable() {
        // Make AJAX request to getAllDepartments.php
        $.ajax({
            url: 'getAllDepartments.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var htmlString = '';

                // Check if the response has data
                if (response && response.data) {
                    $.each(response.data, function (index, department) {
                        htmlString += '<tr class="table-row">' +
                            '<td class="align-middle text-nowrap">'
                            + department.name +
                            '</td>' +
                            '<td class="align-middle text-nowrap d-none d-md-table-cell">'
                            + department.location +
                            '</td>' +
                            '<td class="text-end text-nowrap">' +
                            '<button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editDepartmentModal" data-id="' + department.id + '">' +
                            '<i class="fa-solid fa-pencil fa-fw"></i>' +
                            '</button>' +
                            '<button type="button" class="btn btn-primary btn-sm deleteDepartmentBtn m-2" data-id="' + department.id + '">' +
                            '<i class="fa-solid fa-trash fa-fw"></i>' +
                            '</button>' +
                            '</td>' +
                            '</tr>';
                    });

                    // Append the constructed HTML string to the tbody
                    $('#deparments_data').html(htmlString);

                    // alert('Data deparments appended successfully!');
                } else {
                    console.error('No data received or invalid response structure');
                    alert('No data received or invalid response structure');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function load_locationTable() {
        // Make AJAX request to getAllLocations.php
        $.ajax({
            url: 'getAllLocations.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var htmlString = '';

                // Check if the response has data
                if (response && response.data) {
                    $.each(response.data, function (index, location) {
                        htmlString += '<tr class="table-row" >' +
                            '<td class="align-middle text-nowrap">'
                            + location.name +
                            '</td>' +
                            '<td class="text-end text-nowrap">' +
                            '<button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editLocationModal" data-id="' + location.id + '">' +
                            '<i class="fa-solid fa-pencil fa-fw"></i>' +
                            '</button>' +
                            '<button type="button" class="btn btn-primary btn-sm deleteLocationBtn m-2" data-id="' + location.id + '">' +
                            '<i class="fa-solid fa-trash fa-fw"></i>' +
                            '</button>' +
                            '</td>' +
                            '</tr>';
                    });

                    // Append the constructed HTML string to the tbody
                    $('#locations_data').html(htmlString);

                    // alert('Data location successfully!');
                } else {
                    console.error('No data received or invalid response structure');
                    alert('No data received or invalid response structure');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function getAllLocations(appendId) {
        $.ajax({
            url: 'getAllLocations.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                var resultCode = response.status.code;
                if (resultCode == 200) {
                    $.each(response.data, function () {
                        $("#" + appendId).append(
                            $("<option>", {
                                value: this.id,
                                text: this.name
                            })
                        );
                    });
                } else {
                    console.error('No data received or invalid response structure');
                    alert('No data received or invalid response structure');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function getAllDepartments(appendId) {
        $.ajax({
            url: 'getAllDepartments.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                var resultCode = response.status.code;
                if (resultCode == 200) {
                    $.each(response.data, function () {
                        $("#" + appendId).append(
                            $("<option>", {
                                value: this.id,
                                text: this.name
                            })
                        );
                    });
                } else {
                    console.error('No data received or invalid response structure');
                    alert('No data received or invalid response structure');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    load_personalTable();
    load_deparmentTable();
    load_locationTable();
});
