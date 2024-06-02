$(document).ready(function() {
    
    $("header, nav, img, footer, hr, fieldset").hide();
    showPage(".loginPage");

    $(".loginPage button").click(function() {
        let username = $("#txtUsername").val();
        let password = $("#txtPassword").val();
        if (username == "admin" && password == "admin123") {
            $("header, nav, footer, hr, fieldset").show();
            showPage(".homePage");
            $(".loginPage").hide();
        } else {
            alert("Invalid input! Please try again.");
        }
    });

    $("#chkview").click(function() {
        let isChecked = $(this).is(":checked");
        if (isChecked) {
            $("#txtPassword").attr("type", "text");
            $("#chkview").next("span").text("Hide");
        } else {
            $("#txtPassword").attr("type", "password");
            $("#chkview").next("span").text("Show");
        }
    });

    let links = $("nav a");

    links.on("click", function() {
        links.removeClass("active");
        $(this).addClass("active");
    });

    function showPage(page) {
        $("main .container .card, main .loginPage, main .social, main hr, main fieldset, main .remove").hide();
        $(page).show();
        if (page === ".homePage") {
            $("img").show();
            $(".social").show();
            $("hr").show();
            $("fieldset").show();
            $(".remove").show();
        } else {
            $("img").hide();
            $(".social").hide();
            $("hr").hide();
            $("fieldset").hide();
            $(".remove").hide();

        }
    }

    $(".home").click(function() {
        showPage(".homePage");
    });

    $(".blotter").click(function() {
        showPage(".blotterPage");
        //to load informations
        displayItems();
    });
    // Save the data to the database using AJAX
    $.ajax({
        url: 'blotter.php',
        method: 'POST',
        data: {
            Name: txtComplainantName,
            Address: txtComplainantAddress,
            Accusation: txtAccusation,
            rdoStatus: unsettled,
        },
        success: function(response) {
            console.log(response); // Log the response from the server
            clearResidentData(); // Clear the form fields after successful submission
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors that occur during the AJAX request
        }
    });
}

    $(".clearance").click(function() {
        showPage(".clearancePage");
    });

    $(".indigency").click(function() {
        showPage(".indigencyPage");
    });

    $(".permit").click(function() {
        showPage(".permitPage");
    });

    $(".residence").click(function(){
        showPage(".residencePage")
        imageUpload()
        displayData()
    })

    $(".logout").click(function() {
        if (confirm("Are you sure you want to log out?")) {
            location.reload();
        }
    });

    //Script for Blotter tab
    
    $("#btnSave").click(function() {
        createItem();
        clearFields();

    });

    $("#btnUpdate").click(function() {
        let selectedRow = $("#tblRecords tr.selected");
        if (selectedRow.length === 0) {
            alert("Please select a row to update.");
            return;
        }
        let complainantName = selectedRow.find("td:eq(1)").text();
        let complainantAddress = selectedRow.find("td:eq(2)").text();
        let accusation = selectedRow.find("td:eq(3)").text();
        let rdoStatus = selectedRow.find("td:eq(4)").text();
        $("#txtComplainantName").val(complainantName);
        $("#txtComplainantAddress").val(complainantAddress);
        $("#txtAccusation").val(accusation);
        $('input[name="rdoStatus"][value="' + rdoStatus + '"]').prop("checked", true);
    });

    $("#btnDelete").click(function() {
        let selectedRow = $("#tblRecords tr.selected");
        if (selectedRow.length === 0) {
            alert("Please select a row to delete.");
            return;
        }
        if (confirm("Are you sure you want to delete the selected row?")) {
            selectedRow.remove();
        }
    });

    $("#btnClear").click(function() {
        clearRecords();
    });
    //for new resident tab

    // Event handler for the submit button
    $('#btnsaveInfo').click(function() {
        saveResidentData();
        displayData();
        clearResidentData();
    });
    //Event handler for clear button
      $('#btnclearAll').click(function() {
        deleteAllData();
    });
    $('#btnupdateInfo').click(function() {
        let selectedRow = $("#residentsTable tbody tr.selected");
          if (selectedRow.length === 0) {
            alert("Please select a row to update.");
            return;
          }
        let lastName = selectedRow.find("td:eq(0)").text();
        let firstName = selectedRow.find("td:eq(1)").text();
        let middleName = selectedRow.find("td:eq(2)").text();
        let sex = selectedRow.find("td:eq(3)").text();
        let maritalStatus = selectedRow.find("td:eq(4)").text();
        let address = selectedRow.find("td:eq(5)").text();
        let employmentStatus = selectedRow.find("td:eq(6)").text();
        let birthDate = selectedRow.find("td:eq(7)").text();
        let birthPlace = selectedRow.find("td:eq(8)").text();
        let age = selectedRow.find("td:eq(9)").text();
        let religion = selectedRow.find("td:eq(10)").text();
        let voterStatus = selectedRow.find("td:eq(11)").text();
        
        $("#txtResLName").val(lastName);
        $("#txtResFName").val(firstName);
        $("#txtResMName").val(middleName);
        $('input[name="sex"][value="' + sex + '"]').prop("checked", true);
        $("#maritalStatus").val(maritalStatus);
        $("#txtResAddress").val(address);
        $('input[name="employmentStatus"][value="' + employmentStatus + '"]').prop("checked", true);
        $("#ResBirthDate").val(birthDate);
        $("#txtResBirthPlace").val(birthPlace);
        $("#age").val(age);
        $("#txtResReligion").val(religion);
        $('input[name="voterStatus"][value="' + voterStatus + '"]').prop("checked", true);
       
    });
    $('#btndeleteInfo').click(function() {
        deleteRow();
    });

});
        


function createItem() {
    let complainantName = $("#txtComplainantName").val();
    let complainantAddress = $("#txtComplainantAddress").val();
    let accusation = $("#txtAccusation").val();
    let rdoStatus = $('input[name="rdoStatus"]:checked').val();

    if (complainantName === "" || complainantAddress === "" || accusation === "") {
        alert("Invalid input! Please fill in all fields.");
        return;
    }

    if (/\d/.test(complainantName) || /\d/.test(complainantAddress) || /\d/.test(accusation)) {
        alert("Invalid input! Please try again.");
        return;
    }

    if (!rdoStatus) {
        alert("Please select a status.");
        return;
    }

    let items = JSON.parse(localStorage.getItem("items")) || [];
    let selectedRow = $("#tblRecords tr.selected");
    if (selectedRow.length === 0) {
        // Add a new item to the array
        let data = {
            complainantName: complainantName,
            complainantAddress: complainantAddress,
            accusation: accusation,
            status: rdoStatus
        };
        items.push(data);
    } else {
        // Update the selected item in the array
        let index = selectedRow.index() - 1;
        items[index].complainantName = complainantName;
        items[index].complainantAddress = complainantAddress;
        items[index].accusation = accusation;
        items[index].status = rdoStatus;
        selectedRow.removeClass("selected");
    }

    localStorage.setItem("items", JSON.stringify(items));
    displayItems();
}

function displayItems() {
    let items = JSON.parse(localStorage.getItem("items")) || [];
    let table = $("#tblRecords");
    table.empty();
    table.append("<tr><th>Case ID</th><th>Complainant's Full Name</th><th>Complainant's Address</th><th>Accusation</th><th>Record Status</th></tr>");
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        table.append("<tr><td>" + (i + 1) + "</td><td>" + item.complainantName + "</td><td>" + item.complainantAddress + "</td><td>" + item.accusation + "</td><td>" + item.status + "</td></tr>");
    }
    table.find("tr").not(":first").click(function() {
        table.find("tr").removeClass("selected greyish");
        $(this).addClass("selected");
    });
}

//TEMPORARY lang tong button, naiipon kasi sa storage yung trials na input, para mareset lang ganern
function clearRecords() {
    localStorage.clear();
    displayItems();
}

function clearFields(){

    //values are set to null to clear textboxes
    let complainantName = $("#txtComplainantName").val(null);
    let complainantAddress = $("#txtComplainantAddress").val(null);
    let accusation = $("#txtAccusation").val(null);
    //set the value of radio buttons to false to remove selection
    let rdoStatus = $('input[name="rdoStatus"]').prop('checked',false);
    
}

displayItems();

//Script for New Residence Tab
function imageUpload(){

    let imageInput = document.getElementById('imageInput');

  // Add an event listener to detect when a file is selected
  imageInput.addEventListener('change', function(e) {
    
    // Get the selected file
    let file = e.target.files[0];

    // Create a FileReader object to read the file
    let reader = new FileReader();

    // Set up the FileReader onload event handler
    reader.onload = function(e) {
      // Create an HTML image element and set its source to the data URL
      let img = document.createElement('img');
      img.src = e.target.result;

      localStorage.setItem("recent-image", reader.result)

      // Clear the image preview container
      let imagePreview = document.getElementById('imagePreview');
      imagePreview.innerHTML = '';

      // Append the image element to the container
      imagePreview.appendChild(img);
    };

    // Read the file as a data URL
    reader.readAsDataURL(file);
  });
}
function saveResidentData() {
    let lastName = $('#txtResLName').val().trim();
    let firstName = $('#txtResFName').val().trim();
    let middleName = $('#txtResMName').val().trim();
    let sex = $('input[name="sex"]:checked').val();
    let maritalStatus = $('#maritalStatus').val();
    let address = $('#txtResAddress').val().trim();
    let employmentStatus = $('input[name="employment_status"]:checked').val();
    let birthDate = $('#ResBirthDate').val();
    let birthPlace = $('#txtResBirthPlace').val().trim();
    let age = $('#age').val();
    let religion = $('#txtResReligion').val().trim();
    let voterStatus = $('input[name="voter_status"]:checked').val();

    if (
        lastName === '' ||
        firstName === '' ||
        middleName === '' ||
        address === '' ||
        birthPlace === '' ||
        religion === '' ||
        birthDate === '' ||
        maritalStatus === '' ||
        age === ''
    ) {
        alert('Please fill all fields!');
        return;
    }

    if (!sex || !employmentStatus || !voterStatus) {
        alert('Please select Status!');
        return;
    }

    // Save the data to the database using AJAX
    $.ajax({
        url: 'db.php',
        method: 'POST',
        data: {
            last_name: lastName,
            first_name: firstName,
            middle_name: middleName,
            sex: sex,
            marital_status: maritalStatus,
            address: address,
            employment_status: employmentStatus,
            birth_date: birthDate,
            place_of_birth: birthPlace,
            age: age,
            religion: religion,
            voter_status: voterStatus
        },
        success: function(response) {
            console.log(response); // Log the response from the server
            clearResidentData(); // Clear the form fields after successful submission
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors that occur during the AJAX request
        }
    });
}
            
function displayData() {
    let residents = JSON.parse(localStorage.getItem('residents')) || [];
    let tableBody = $('#residentsTable tbody');
    tableBody.empty();
                
    // Iterate through residents and create table rows
    residents.forEach(function(resident) {
    let row = $('<tr>');
    row.append($('<td>').text(resident.lastName));
    row.append($('<td>').text(resident.firstName));
    row.append($('<td>').text(resident.middleName));
    row.append($('<td>').text(resident.sex));
    row.append($('<td>').text(resident.maritalStatus));
    row.append($('<td>').text(resident.address));
    row.append($('<td>').text(resident.employmentStatus));
    row.append($('<td>').text(resident.birthDate));
    row.append($('<td>').text(resident.birthPlace));
    row.append($('<td>').text(resident.age));
    row.append($('<td>').text(resident.religion));
    row.append($('<td>').text(resident.voterStatus));     


    row.click(function() {
        $('#residentsTable tbody tr').removeClass('selected'); // Remove 'selected' class from all rows
        row.addClass('selected'); // Add 'selected' class to the clicked row
    });
    tableBody.append(row);

    });
}
    // Function to clear all input fields
function clearResidentData() {
    $('#imagePreview').hide();
    $('#txtResLName').val('');
    $('#txtResFName').val('');
    $('#txtResMName').val('');
    $('input[name="sex"]').prop('checked', false);
    $('#maritalStatus').val('');
    $('#txtResAddress').val('');
    $('input[name="employmentStatus"]').prop('checked', false);
    $('#ResBirthDate').val('');
    $('#txtResBirthPlace').val('');
    $('#age').val('');
    $('#txtResReligion').val('');
    $('input[name="voterStatus"]').prop('checked', false);

}

function deleteAllData() {
    // Clear local storage
    localStorage.removeItem('residents');
    
    // Clear table body
    $('#residentsTable tbody').empty();
}

function deleteRow() {
    let selectedRow = $('#residentsTable tbody tr.selected');
    if (selectedRow.length === 0) {
      alert('Please select a row to delete.');
      return;
    }

    let index = selectedRow.attr('data-index');
    let residents = JSON.parse(localStorage.getItem('residents')) || [];

    // Remove the resident at the specified index
    residents.splice(index, 1);

    // Update local storage
    localStorage.setItem('residents', JSON.stringify(residents));

    // Remove the row from the table
    selectedRow.remove();
  }