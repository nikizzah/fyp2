<!DOCTYPE html>
<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->
<html lang="en-us">

    @include('css')
    @include('advisor.navbar')

<body>
    <section class="section">
        <br>
        <div style="display: flex; align-items: center">
        <h4 style="color:black; margin-left: 20px;">Planning - Course Structure for </h4>
            <h4 style="color:#A45C40">&nbsp;{{$advisee['advisee_fname']}}</h4>
        </div>
        <br>
        <center>
            <h4>LOCAL BACHELOR OF COMPUTER SCIENCE (SOFTWARE ENGINEERING) (HONS.)</h4>
        </center>
        <br>
        @livewire('advisor-plan', ['advisee' => $advisee])
        <br>
    </section>

    <!-- JS Plugins -->
    @include('script')
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.11/dist/interact.min.js"></script>


    <script>
        document.addEventListener('livewire:load', function () {
        const subjects = document.querySelectorAll('.subject-list tr[draggable="true"]');
        const tables = document.querySelectorAll('.table');

        subjects.forEach((subject) => {
            subject.addEventListener('dragstart', handleDragStart);
        });

        tables.forEach((table) => {
            table.addEventListener('dragover', handleDragOver);
            table.addEventListener('drop', handleDrop);
            table.setAttribute('draggable', 'false');
        });

        function handleDragStart(e) {
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.subjectCode);
            e.dataTransfer.setData('text/semester', this.dataset.semesterId); // Store the semester ID in the drag event
            this.classList.add('dragging');
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }

        function handleDrop(e) {
            e.preventDefault();
            const subjectCode = e.dataTransfer.getData('text/plain');
            const sourceSemesterId = e.dataTransfer.getData('text/semester');
            const targetTable = this; //dropped table
            const targetTableId = targetTable.id;
            const subjectRow = document.querySelector(`.subject-list tr[data-subject-code="${subjectCode}"]`);
            const prerequisite = subjectRow.querySelector('.prerequisite').textContent;
            const name = subjectRow.querySelector('.name').textContent;

            if (name === 'Industrial Training') {
                const otherSubjectTable = document.querySelector('.subject-list .table:not([data-name="Industrial Training"])');
                if (otherSubjectTable && otherSubjectTable.querySelectorAll('tr').length > 0) {
                    const errorIntern = 'Cannot take subject during Industrial Training.';
                    alert(errorIntern);
                    return;
                }

            } else {
                    const internTable = document.querySelector('.subject-list tr[data-name="Industrial Training"]').closest('.table');
                    const internTableId = internTable.id;
                    if (targetTableId === internTableId) {
                        const errorIntern = 'Cannot take subject during Industrial Training.';
                        alert(errorIntern);
                        return;
                    }
            }
            
            // Check if the prerequisite is "None"
            if (prerequisite === 'None' || prerequisite === 'none') {
                // Find the row of the subject being dropped
                const subjectRow = document.querySelector(`.subject-list tr[data-subject-code="${subjectCode}"]`);
                console.log(subjectRow);
                // Get the subject code from the subject row
                const prerequisiteCode = subjectRow.getAttribute('data-subject-code');
                // Find all rows in the target table that have prerequisites
                const prerequisiteTable = Array.from(targetTable.querySelectorAll(`tr[data-prerequisite]`));
                console.log(prerequisiteTable);

                // Check if the subject code is listed as a prerequisite in any of the rows
                for (const row of prerequisiteTable) {
                    const prerequisites = row.getAttribute('data-prerequisite').split('&').map(code => code.trim());
                    console.log(prerequisites);
                    const prerequisiteTable = row.closest('.table');
                    const prerequisiteTableId = prerequisiteTable.id;

                    if (prerequisites.includes(subjectCode)) {
                        console.log(subjectCode);
                        if (prerequisiteTableId <= targetTableId) {
                            // The target table is positioned after the table with the subject as a prerequisite
                            const errorMessage = 'Prerequisite subject must be completed first.';
                            alert(errorMessage);
                            return;
                        }
                    }
                }

                    // Get the index of the target table
                        const targetTableIndex = Array.from(tables).indexOf(targetTable);

                        // Iterate over the tables preceding the target table
                        for (let i = targetTableIndex - 1; i >= 0; i--) {
                            const prerequisiteTablebfr = tables[i];
                            const prerequisiteTablebfrId = prerequisiteTablebfr.id;

                            // Find all rows in the prerequisite table that have prerequisites
                            const prerequisitebfrRows = prerequisiteTablebfr.querySelectorAll('tr[data-prerequisite]');

                            // Check if the subject code is listed as a prerequisite in any of the rows
                            for (const row of prerequisitebfrRows) {
                                const prerequisites = row.getAttribute('data-prerequisite').split('&').map(code => code.trim());

                                if (prerequisites.includes(subjectCode)) {
                                    // The prerequisite table contains the subject code as a prerequisite
                                    const errorMessage = 'Prerequisite subject must be completed first.';
                                    alert(errorMessage);
                                    return;
                                }
                            }
                        }
            // subject with prerequisite (main)
            } else {
                if (prerequisite.includes('&')) {
                    const prerequisiteSubjects = prerequisite.split('&').map(subject => subject.trim());
                    for (const prerequisiteSubject of prerequisiteSubjects) {
                        const prerequisiteRowInTargetTable = document.querySelector(`.subject-list tr[data-subject-code="${prerequisiteSubject}"]`);
                        const prerequisiteTable = prerequisiteRowInTargetTable.closest('.table');
                        const prerequisiteTableId = prerequisiteTable.id;
                        if (targetTableId <= prerequisiteTableId) {
                            const errorMessage = 'Prerequisite subject must be completed first.';
                            alert(errorMessage);
                            return;
                        }
                    }
                }else{
                    const prerequisiteRowInTargetTable = document.querySelector(`.subject-list tr[data-subject-code="${prerequisite}"]`);
                    const prerequisiteTable = prerequisiteRowInTargetTable.closest('.table');
                    const prerequisiteTableId = prerequisiteTable.id;
                    if (targetTableId <= prerequisiteTableId) {
                        const errorMessage = 'Prerequisite subject must be completed first.';
                        alert(errorMessage);
                        return;
                    }
                }
                // Find all rows in the target table that have prerequisites
                const prerequisitesInTargetTable = targetTable.querySelectorAll(`tr[data-prerequisite]`);
                console.log(prerequisitesInTargetTable);
                // Check if the subject code is listed as a prerequisite in any of the rows
                for (const row of prerequisitesInTargetTable) {
                    const prerequisiteSubjectCodes = row.getAttribute('data-prerequisite').split('&').map(code => code.trim());

                    if (prerequisiteSubjectCodes.includes(subjectCode)) {
                        // The target table contains the subject code as a prerequisite
                        const errorMessage = 'Prerequisite subject must be placed before the main subject.';
                        alert(errorMessage);
                        return;
                    }
                }

            }
            targetTable.querySelector('tbody').appendChild(subjectRow);
            Livewire.emit('updateSubjectSemester', subjectCode, sourceSemesterId, targetTableId);
            subjects.forEach((subject) => {
                subject.classList.remove('dragging');
            });

            Livewire.hook('element.updated', () => {
                location.reload();
            });
        }
    });
</script>
<script>
document.addEventListener('livewire:load', function () {
    // Check the changes in the grade selection
    const gradeSelects = document.querySelectorAll('.subject-list select[name^="grade"]');
    gradeSelects.forEach((select) => {
        select.addEventListener('change', handleGradeSelectChange);
    });

    function handleGradeSelectChange(e) {
        const subjectCode = e.target.name.split('[')[1].split(']')[0];
        const grade = e.target.value || 0;
        const semesterName = e.target.closest('.table').id;
        console.log(semesterName);
        Livewire.emit('updateGrade', subjectCode, grade, semesterName);
    }

    Livewire.on('gpaCalculated', (semesterName, gpa, cgpa) => {
        // Update the GPA display for the specific semester here
        console.log(semesterName);
        console.log(cgpa);
        const gpaAdvisee = document.querySelector(`#${semesterName} .gpa`);
        gpaAdvisee.textContent = gpa.toFixed(2);
    
        const cgpaAdvisee = document.querySelector(`#${semesterName} .cgpa`);
        console.log(cgpaAdvisee);
        cgpaAdvisee.textContent = (cgpa !== 'N/A') ? cgpa.toFixed(2) : 'N/A';
    });
});
</script>

</body>
</html>
