document.addEventListener('DOMContentLoaded', function() {
    const testButtons = document.querySelectorAll('.test-button');
    const testModal = document.getElementById('testModal');
    const displayModal = document.getElementById('displayModal');
    const modalTitle = document.getElementById('modalTestType');
    const fillUpButton = document.getElementById('fillUpButton');
    const displayButton = document.getElementById('displayButton');
    const closeDisplay = document.getElementById('closeDisplay');
    const displayModalTitle = document.getElementById('displayModalTitle');
    const displayContent = document.getElementById('displayContent');
    const modalCloses = document.querySelectorAll('.modal .close');
  
    let selectedTest = '';
  
    // When any test button is clicked, open the test options modal.
    testButtons.forEach(button => {
      button.addEventListener('click', function() {
        selectedTest = this.textContent.split(" ")[0];
        modalTitle.textContent = selectedTest + " Test Options";
        testModal.style.display = 'block';
      });
    });
  
    // When "Fill Up" is clicked, redirect to the corresponding PHP form.
    fillUpButton.addEventListener('click', function() {
      let redirectUrl = "";
      if (selectedTest === "Physical") {
        redirectUrl = "physical.php?id=" + patientId;
      } else if (selectedTest === "Diagnostic") {
        redirectUrl = "diagnostic.php?id=" + patientId;
      } else if (selectedTest === "Diagnosis") {
        redirectUrl = "diagnosis.php?id=" + patientId;
      }
      window.location.href = redirectUrl;
    });
  
    // When "Display" is clicked, fetch test information via AJAX.
    displayButton.addEventListener('click', function() {
      testModal.style.display = 'none';
      displayModalTitle.textContent = selectedTest + " Test Information";
      fetch("profile.php?ajax=1&test=" + encodeURIComponent(selectedTest) + "&patient_id=" + encodeURIComponent(patientId))
        .then(response => response.json())
        .then(result => {
          if (result.data) {
            let data = result.data;
            let htmlContent = "";
            if (selectedTest === "Physical") {
              htmlContent += "<div class='test-section'>";
              htmlContent += "<h3>Physical Test Details</h3>";
              htmlContent += "<div class='field'><strong>Full Name:</strong> <span>" + data.full_name + "</span></div>";
              htmlContent += "<div class='field'><strong>Date of Birth:</strong> <span>" + data.dob + "</span></div>";
              htmlContent += "<div class='field'><strong>Age:</strong> <span>" + data.age + "</span></div>";
              htmlContent += "<div class='field'><strong>Gender:</strong> <span>" + data.gender + "</span></div>";
              htmlContent += "<div class='field'><strong>Past Medical History:</strong> <span>" + data.past_medical_history + "</span></div>";
              htmlContent += "<div class='field'><strong>Family Medical History:</strong> <span>" + data.family_medical_history + "</span></div>";
              htmlContent += "<div class='field'><strong>Allergies:</strong> <span>" + data.allergies + "</span></div>";
              htmlContent += "<div class='field'><strong>Current Medications:</strong> <span>" + data.current_medications + "</span></div>";
              htmlContent += "<div class='field'><strong>Height:</strong> <span>" + data.height + " cm</span></div>";
              htmlContent += "<div class='field'><strong>Weight:</strong> <span>" + data.weight + " kg</span></div>";
              htmlContent += "<div class='field'><strong>BMI:</strong> <span>" + data.bmi + "</span></div>";
              htmlContent += "<div class='field'><strong>Blood Pressure:</strong> <span>" + data.blood_pressure + "</span></div>";
              htmlContent += "<div class='field'><strong>Heart Rate:</strong> <span>" + data.heart_rate + " bpm</span></div>";
              htmlContent += "<div class='field'><strong>Temperature:</strong> <span>" + data.temperature + " °C</span></div>";
              htmlContent += "<div class='field'><strong>General Appearance:</strong> <span>" + data.general_appearance + "</span></div>";
              htmlContent += "<div class='field'><strong>Head and Neck:</strong> <span>" + data.head_and_neck + "</span></div>";
              htmlContent += "<div class='field'><strong>Eyes:</strong> <span>" + data.eyes + "</span></div>";
              htmlContent += "<div class='field'><strong>Ears:</strong> <span>" + data.ears + "</span></div>";
              htmlContent += "<div class='field'><strong>Nose and Throat:</strong> <span>" + data.nose_and_throat + "</span></div>";
              htmlContent += "<div class='field'><strong>Chest and Lungs:</strong> <span>" + data.chest_and_lungs + "</span></div>";
              htmlContent += "<div class='field'><strong>Heart:</strong> <span>" + data.heart + "</span></div>";
              htmlContent += "<div class='field'><strong>Abdomen:</strong> <span>" + data.abdomen + "</span></div>";
              htmlContent += "</div>";
            } else if (selectedTest === "Diagnostic") {
              htmlContent += "<div class='test-section'>";
              htmlContent += "<h3>Diagnostic Test Details</h3>";
              htmlContent += "<div class='field'><strong>Full Name:</strong> <span>" + data.full_name + "</span></div>";
              htmlContent += "<div class='field'><strong>Date of Birth:</strong> <span>" + data.dob + "</span></div>";
              htmlContent += "<div class='field'><strong>Age:</strong> <span>" + data.age + "</span></div>";
              htmlContent += "<div class='field'><strong>Gender:</strong> <span>" + data.gender + "</span></div>";
              htmlContent += "<h4>Urinalysis</h4>";
              htmlContent += "<div class='field'><strong>Color:</strong> <span>" + data.ur_color + "</span></div>";
              htmlContent += "<div class='field'><strong>Transparency:</strong> <span>" + data.ur_transparency + "</span></div>";
              htmlContent += "<div class='field'><strong>Hemoglobin:</strong> <span>" + data.ur_hemoglobin + "</span></div>";
              htmlContent += "<div class='field'><strong>Hematocrit:</strong> <span>" + data.ur_hematocrit + "</span></div>";
              htmlContent += "<div class='field'><strong>WBC:</strong> <span>" + data.ur_wbc + "</span></div>";
              htmlContent += "<div class='field'><strong>Pus:</strong> <span>" + data.ur_pus + "</span></div>";
              htmlContent += "<div class='field'><strong>RBC:</strong> <span>" + data.ur_rbc + "</span></div>";
              htmlContent += "<div class='field'><strong>Platelet:</strong> <span>" + data.ur_platelet + "</span></div>";
              htmlContent += "<h4>Fecalysis</h4>";
              htmlContent += "<div class='field'><strong>Color:</strong> <span>" + data.fec_color + "</span></div>";
              htmlContent += "<div class='field'><strong>Consistency:</strong> <span>" + data.fec_consistency + "</span></div>";
              htmlContent += "<div class='field'><strong>Mucus:</strong> <span>" + data.fec_mucus + "</span></div>";
              htmlContent += "<div class='field'><strong>Blood:</strong> <span>" + data.fec_blood + "</span></div>";
              htmlContent += "<div class='field'><strong>Parasites:</strong> <span>" + data.fec_parasites + "</span></div>";
              htmlContent += "<div class='field'><strong>Ova:</strong> <span>" + data.fec_ova + "</span></div>";
              htmlContent += "<h4>X‑ray</h4>";
              htmlContent += "<div class='field'><strong>Region:</strong> <span>" + data.xray_region + "</span></div>";
              htmlContent += "<div class='field'><strong>Findings:</strong> <span>" + data.xray_findings + "</span></div>";
              htmlContent += "<div class='field'><strong>Impression:</strong> <span>" + data.xray_impression + "</span></div>";
              htmlContent += "<div class='field'><strong>Recommendation:</strong> <span>" + data.xray_recommendation + "</span></div>";
              htmlContent += "<h4>Blood Analysis</h4>";
              htmlContent += "<div class='field'><strong>Hemoglobin:</strong> <span>" + data.blood_hemoglobin + "</span></div>";
              htmlContent += "<div class='field'><strong>Hematocrit:</strong> <span>" + data.blood_hematocrit + "</span></div>";
              htmlContent += "<div class='field'><strong>WBC:</strong> <span>" + data.blood_wbc + "</span></div>";
              htmlContent += "<div class='field'><strong>RBC:</strong> <span>" + data.blood_rbc + "</span></div>";
              htmlContent += "<div class='field'><strong>Platelet:</strong> <span>" + data.blood_platelet + "</span></div>";
              htmlContent += "<div class='field'><strong>Other:</strong> <span>" + data.blood_other + "</span></div>";
              htmlContent += "</div>";
            } else if (selectedTest === "Diagnosis") {
              htmlContent += "<div class='test-section'>";
              htmlContent += "<h3>Diagnosis Test Details</h3>";
              htmlContent += "<div class='field'><strong>Full Name:</strong> <span>" + data.full_name + "</span></div>";
              htmlContent += "<div class='field'><strong>Date of Birth:</strong> <span>" + data.dob + "</span></div>";
              htmlContent += "<div class='field'><strong>Age:</strong> <span>" + data.age + "</span></div>";
              htmlContent += "<div class='field'><strong>Gender:</strong> <span>" + data.gender + "</span></div>";
              htmlContent += "<div class='field'><strong>Subjective Symptoms:</strong> <span>" + data.subjective_symptoms + "</span></div>";
              htmlContent += "<div class='field'><strong>Objective Findings:</strong> <span>" + data.objective_findings + "</span></div>";
              htmlContent += "<div class='field'><strong>Assessment Goals:</strong> <span>" + data.assessment_goals + "</span></div>";
              htmlContent += "<div class='field'><strong>Diagnosis:</strong> <span>" + data.diagnosis + "</span></div>";
              htmlContent += "<div class='field'><strong>Treatment Plans:</strong> <span>" + data.treatment_plans + "</span></div>";
              htmlContent += "<div class='field'><strong>Medications:</strong> <span>" + data.medications + "</span></div>";
              htmlContent += "<div class='field'><strong>Therapies:</strong> <span>" + data.therapies + "</span></div>";
              htmlContent += "<div class='field'><strong>Follow Up:</strong> <span>" + data.follow_up + "</span></div>";
              htmlContent += "</div>";
            }
            displayContent.innerHTML = htmlContent;
          } else {
            displayContent.innerHTML = "<p>" + (result.message || "No test data available for this patient.") + "</p>";
          }
          displayModal.style.display = 'block';
        })
        .catch(error => {
          console.error('Error fetching test data:', error);
          displayContent.innerHTML = "<p>Error fetching test data.</p>";
          displayModal.style.display = 'block';
        });
    });
  
    // Close any modal when clicking on its close button.
    modalCloses.forEach(closeBtn => {
      closeBtn.addEventListener('click', function() {
        this.parentElement.parentElement.style.display = 'none';
      });
    });
  
    // Close modal if user clicks outside the modal content.
    window.addEventListener('click', function(event) {
      if (event.target === testModal) {
        testModal.style.display = 'none';
      }
      if (event.target === displayModal) {
        displayModal.style.display = 'none';
      }
    });
  });
  