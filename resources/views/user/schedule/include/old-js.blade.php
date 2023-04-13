@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
    <script>


        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.custom-select').select2();
        });


        $( ".schedule-item-list" ).droppable({
            accept: ".schedule-dragable-item",
            classes: {
            "ui-droppable-active": "ui-state-active",
            "ui-droppable-hover": "ui-state-hover"
            },
            drop: function( event, ui ) {

                const draggableValues = ui.draggable.attr("rel");
                const draggableArray = draggableValues.split("-|-");

                
                const schedule_id = draggableArray[8];
                const target_user_id = event.target.attributes[3].value;
                const target_date = event.target.attributes[4].value;


                const type = "{{ request()->active }}";
                // console.log(draggableArray);


                // console.log(`schedule_id = ${schedule_id} : target_user_id = ${target_user_id} : target_date : ${target_date}`);


                var url = "{{ url('/schedule/drag/update/') }}/"+schedule_id;
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        date: target_date,
                        user_id: target_user_id,
                        type: type,
                    },
                    success: function(resp) {
                        location.reload();
                    },
                    error: function(resp) {
                        alert("Opps Try Agian...");
                    }
                });
                



            }
        });

        

        $(function(){
            $.contextMenu({
                selector: '.context-menu-one', 
                className: 'context-menu-one-title',
                trigger: 'right',
                callback: function(key, options) {
                    
                    const contextMenuValues = options.$trigger.attr("rel");
                    const contextMenuRef = options.$trigger.attr("ref");
                    const contextMenuDataItem = options.$trigger.attr("data-item");
                    const contextMenuArray = contextMenuValues.split("-|-");

                    if (key === "edit") {


                        var group_id= options.$trigger.attr('group_id');
                        var groupArray = group_id.split(",");            

                        var location_id= options.$trigger.attr('location_id');
                        var locationArray = location_id.split(",");            

                        var assignments= options.$trigger.attr('assignments');
                        var assignmentArray = assignments.split("-|-");

                        $.each(assignmentArray, function(key, option){
                            $('#assignment10').append(option);
                        });
                        $('#assignment10').trigger('change'); 

                        $('#location_ids0').val(locationArray);
                        $('#location_ids0').trigger('change'); 

                        $('#group_ids0').val(groupArray);
                        $('#group_ids0').trigger('change');                

                        $("#pills-tabContent").hide();
                        $("#UpdateScheduleLoading").show();
                        


                        $("#UpdateScheduleHeader").html(`Update Schedule ${contextMenuRef}`);

              
                        
                        $("#customer_id").val(contextMenuArray[0]);
                        $("#staff_id").val(contextMenuArray[1]);
                        $("#hourly_wags").val(contextMenuArray[2]);
                        $("#date001").val(contextMenuArray[3]);
                        $("#start_time").val(contextMenuArray[4]);
                        $("#end_time").val(contextMenuArray[5]);
                        $("#status").val(contextMenuArray[6]);
                        $("#visibility").val(contextMenuArray[7]);
                        $("#schedule_id000").val(contextMenuArray[8]);
                        



                        $("#MyUpdateScheduleForm").attr("action",`{{ url('/schedule/update/') }}/${contextMenuArray[8]}`);
                        $("#MyCopyScheduleForm").attr("action",`{{ url('/schedule/copy/') }}/${contextMenuArray[8]}`);
                        // $("#MyNoteScheduleForm").attr("action",`{{ url('/schedule/note/store/') }}/${contextMenuArray[8]}`);
                        $("#DeleteSchedule").attr("href",`{{ url('/schedule/delete/') }}/${contextMenuArray[8]}`);
                        // console.log(contextMenuArray);

                        $(".UpdateClose").attr("data-item",contextMenuDataItem)
                        $("#UpdateSchedule").attr("id","UpdateSchedule"+contextMenuDataItem)
                        $("#UpdateSchedule"+contextMenuDataItem).modal('show');



                        get_notes(contextMenuArray[8]);


                        $('.custom-select').select2();
                        $('.custom-select').select2({
                          dropdownParent: $("#UpdateSchedule"+contextMenuDataItem)
                        });


                        $("#pills-tabContent").show();
                        $("#UpdateScheduleLoading").hide();
                    }else if(key == "cut"){
                        sessionStorage.setItem("schedule___id", contextMenuArray[8]);
                        sessionStorage.setItem("action___type", "Cut");
                    }else if(key == "copy"){
                        sessionStorage.setItem("schedule___id", contextMenuArray[8]);
                        sessionStorage.setItem("action___type", "Copy");                        
                        // alert('copy');
                    }else if(key == "delete"){
                        if (confirm("Are you sure to delete ?") == true) {
                            window.location.replace(`{{ url('/schedule/delete/') }}/${contextMenuArray[8]}`);
                        }
                    }
                },
                items: {
                    "edit": {name: "Edit", icon: "edit"},
                    "cut": {name: "Cut", icon: "cut"},
                    "copy": {name: "Copy", icon: "copy"},
                    "sep1": "---------",
                    "delete": {name: "Delete", icon: "delete"},                    
                }
            });
        });



        // $(function() {
        //     $(this).bind("contextmenu", function(e) {
        //         e.preventDefault();
        //     });
        // }); 

        $(function(){
            $.contextMenu({
                selector: '.context-menu-two', 
                className: 'context-menu-two-title',
                trigger: 'right',
                callback: function(key, options) {

                    const contextMenuUserId = options.$trigger.attr("ref");
                    const contextMenuDate = options.$trigger.attr("ref1");
                    var value= options.$trigger.attr('data-item');
                    var userId= options.$trigger.attr('ref');
                    var date= options.$trigger.attr('ref1');
                    var ref2= options.$trigger.attr('ref2');

                    if(key === "paste"){
                        const type = "{{ request()->active }}";
                        const schedule___id = sessionStorage.getItem("schedule___id");
                        const action___type = sessionStorage.getItem("action___type");


                        if(sessionStorage.getItem("schedule___id") == null)
                        {
                            tata.error('Opps...', 'Please copy or cut schedule first...', {
                                position: 'tr',
                                duration: 5000,
                                animate: 'slide'
                            });
                            return;
                        }
                        else
                        {
                            if(action___type === "Cut"){
                                 var url = "{{ url('/schedule/drag/update/') }}/"+schedule___id;
                             }else{
                                var url = "{{ url('/schedule/copy/ajax/') }}/"+schedule___id;
                             }
                             $.ajax({
                                 type: 'get',
                                 url: url,
                                 data: {
                                     date: contextMenuDate,
                                     user_id: contextMenuUserId,
                                     type: type,
                                 },
                                 success: function(resp) {
                                     // sessionStorage.clear();
                                     location.reload();
                                 },
                                 error: function(resp) {
                                     alert("Opps Try Agian...");
                                 }
                             });
                        }
                    }else if(key === "add"){
                        $(".CreateClose").attr("data-item",value);
                        $("#CreateSchedule").attr("id","CreateSchedule"+value);
                        $("#CreateScheduleHeader").html(`Schedule for ${ref2}`);
                        
                        $("#date1").val(date);
                        @if (request()->active == "Customer")
                            $("#customer_id1").val(userId);
                        @else
                            $("#staff_id1").val(userId);
                        @endif

                        $('.custom-select').select2();
                        $('.custom-select').select2({
                          dropdownParent: $("#CreateSchedule"+value)
                        });

                        $("#CreateSchedule"+value).modal('show');
                    }else if (key === "availability"){

                        @if (request()->active == "Staff")
                            $("#staff_id0").val(userId);
                        @endif
                        $("#date0").val(date);


                        $('.custom-select').select2();
                        $('.custom-select').select2({
                            dropdownParent: $('#CanNotWork')
                        });
                        $("#CanNotWork").modal('show');
                        $("#NotWorkingLoading").hide();
                        $("#NotWorkingForm").show();
                    }

                },
                items: {
                    "paste": {name: "Paste", icon: "paste"},
                    "add": {name: "Create Schedule", icon: "add"},
                    "availability": {name: "Add Availability", icon: "add"},
                    
                }
            });
        });

        $(".schedule-dragable-item").draggable({
            // connectToSortable: $('.drag-container'),
            containment: $(".drag-container"),
            // helper: "clone",
            revert: "invalid",
        });  
    




        $(".time_not_working").hide();
        $("#all-days-switch").on('change', function() {
            if($(this).is(":checked")) {
                $(".time_not_working").hide();
            }else{
                $(".time_not_working").show();
            }
        });


        $("#end_date").on('change', function() {
            let start_date = $("#start_date").val();
            let end_date = $(this).val();
            
            var url = "{{ url('/schedule/by/date-range') }}";
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    start_date: start_date,
                    end_date: end_date,
                },
                success: function(response)
                {
                    // console.log(response.length);

                    
                    $('#totalShifts').html(response.length);
                    $('#schedule_list').empty();
                    $("#end_date").blur();

                    if(response.length === 0){
                        $('#schedule_list').append(`
                            <h4>No record found...</h4>
                        `);
                        
                    }else{



                        response.forEach(function(item){
                            
                            var status = item.status;
                            var start_time = item.start_time;
                            var end_time = item.end_time;
                            var customer = item.customer;
                            var staff = item.staff;

                            var staffData = '';
                            if(staff !== null){
                                staffData = `<div class="details" style="font-size: 0.74rem !important;"><i data-toggle="tooltip" title="Staff" data-feather="user"></i> ${staff}</div>`;
                            }else{
                                staffData = '';
                            }

                            var cistomerData = '';
                            if(customer !== null){
                                cistomerData = `<div class="details" style="font-size: 0.74rem !important;"><i data-toggle="tooltip" title="Customer" data-feather="briefcase"></i> ${customer}</div>`;
                            }else{
                                cistomerData = '';
                            }

                            var date = item.dateNew;


                            var icons = '';

                          


                            if(status === "Pending"){
                                icons = `<i class="color-border bg-warning"></i>`;
                            }else if(status === "Accepted"){
                                icons = `<i class="color-border bg-success"></i>`;                            
                            }else{
                                icons = `<i class="color-border bg-danger"></i>`;                            
                            }

                            var tr_str = `
                                <a class="not-published schedule-item schedule-dragable-item shift ">
                                    ${icons}
                                    <div class="heading">
                                        <div class="title" style="font-size: 0.74rem !important;">${start_time} - ${end_time}<span class="time-in-org-tz"></span></div>
                                            
                                        </div>
                                        ${staffData}
                                        ${cistomerData}
                                        
                                        <div class="details" style="font-size: 0.74rem !important;"><i data-feather="calendar"></i> ${date}</div>
                                    
                                </a>
                            `;
                            
                            
                            $("#schedule_list").append(tr_str);
                            
                        })

                        feather.replace();
                    }
                   
                    
                    
                },
                error: function(resp) {
                    alert("Opps Try Agian...");
                }
            });


        });





        


        $("#NotWorkingLoading").hide();
        $(".notWorkingActionDelete").hide();
        $("#NotWorkingForm").show();

        $(document).on("click", ".CanNotWorkModal", function () {
            $('.custom-select').select2();
            $('.custom-select').select2({
                dropdownParent: $('#CanNotWork')
            });
            $("#CanNotWork").modal('show');
            $("#NotWorkingLoading").hide();
            $("#NotWorkingForm").show();
        });

        @if (request()->active == "Staff")
        $(document).on("click", ".updateNotWork", function () {
            $("#NotWorkingLoading").show();
            $("#NotWorkingForm").hide();
            var id= $(this).attr('data-id');
            // alert(id);            


            $('.custom-select').select2();
            $('.custom-select').select2({
                dropdownParent: $('#CanNotWork')
            });
            $("#CanNotWork").modal('show');
            $(".notWorkingActionDelete").show();






            var url = "{{ url('/schedule/not/working/single/') }}/"+id;
            $.ajax({
                type: 'get',
                url: url,
                success: function(response)
                {
                    // console.log(response);
                    


                    $("#NotWorkingForm").attr("action",`{{ url('/schedule/not/working/update/') }}/${id}`);
                    $("#notWorkingActionA").attr("href",`{{ url('/schedule/not/working/delete/') }}/${id}`);
                    $("#staff_id0").val(response.staff_id);
                    $("#customer_id0").val(response.customer_id);
                    $("#date0").val(response.date);
                    $("#start_time_not").val(response.start_time);
                    $("#end_time_not").val(response.end_time);
                    $("#note0").val(response.note);
                    $("#status0").val(response.status);
                    $(".notWorkingActionButton").html('<i class="me-1" data-feather="edit-2"></i> Update');
                    $(".NotWorkingModalTitlle").html('<i class="me-1" data-feather="edit-2"></i>Update Tilgængelighed');

                    if(response.allDay == "Null"){
                        $(".time_not_working").show();
                        $("#all-days-switch").prop( "checked", true );
                    }else{
                        $("#all-days-switch").prop( "checked", false );
                        $(".time_not_working").hide();                        
                    }

                    feather.replace();

                    $('.custom-select').select2();
                    $('.custom-select').select2({
                        dropdownParent: $('#CanNotWork')
                    });
                    $("#NotWorkingLoading").hide();
                    $("#NotWorkingForm").show();



                },
                error: function(resp) {
                    alert("Opps Try Agian...");
                }
            });
            
        });
    
        @endif
        $(document).on("click", ".NotWorkingModalClose", function () {
            

            $("#NotWorkingForm").attr("action",`{{ url('/schedule/not/working') }}`);
            $("#notWorkingActionA").attr("href",``);

            $("#staff_id0").val(null);
            $("#customer_id0").val(null);
            $("#date0").val(null);
            $("#start_time_not").val(null);
            $("#end_time_not").val(null);
            $("#note0").val(null);
            $("#status0").val(null);
            $(".notWorkingActionButton").html('<i class="me-1" data-feather="plus"></i> Create');
            $(".NotWorkingModalTitlle").html('<i class="me-1" data-feather="alert-triangle"></i> Tilgængelighed');
            $(".notWorkingActionDelete").hide();
            
            $("#all-days-switch").prop( "checked", false );
            $(".time_not_working").hide();                        
            

            feather.replace();
            $("#CanNotWork").modal('hide');
        });








        $(".CreateNoteContainer").hide();
        $(".CreateNoteBtn").click(function(){
            $(".CreateNoteContainer").show();
        });

        $(".CreateNoteClose").click(function(){
            $(".CreateNoteContainer").hide();
        });

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
   

        $("#CreateSchedule").attr("id","CreateSchedule");
        $("#UpdateSchedule").attr("id","UpdateSchedule");
         
        $(document).on("click", ".UpdateClose", function () {
            var value= $(this).attr('data-item');
            $("#UpdateSchedule"+value).attr("id","UpdateSchedule");

             
        });
        $(document).on("click", ".CreateClose", function () {
            var value= $(this).attr('data-item');
            $("#CreateSchedule"+value).attr("id","CreateSchedule");
            $('#assignment1').empty(); 
             
        });


        


        $(document).on("click", ".OpenCreateModal", function () {
            var value= $(this).attr('data-item');
            var userId= $(this).attr('ref');
            var date= $(this).attr('ref1');
            var ref2= $(this).attr('ref2');

            var group_id= $(this).attr('group_id');
            var groupArray = group_id.split(",");            

            var location_id= $(this).attr('location_id');
            var locationArray = location_id.split(",");            

            var assignments= $(this).attr('assignments');
            var assignmentArray = assignments.split("-|-");
            console.log(assignmentArray);
            
            $(".CreateClose").attr("data-item",value);
            $("#CreateSchedule").attr("id","CreateSchedule"+value);
            $("#CreateScheduleHeader").html(`Schedule for ${ref2}`);
            
            $("#date1").val(date);
            @if (request()->active == "Customer")
                $("#customer_id11").val(userId);
                
                $.each(assignmentArray, function(key, option){
                    $('#assignment1').append(option);
                });
                $('#assignment1').trigger('change'); 

                $('#location_ids').val(locationArray);
                $('#location_ids').trigger('change'); 

            @else
                $("#staff_id1").val(userId);

                $('#group_ids').val(groupArray);
                $('#group_ids').trigger('change'); 

            @endif

            $('.custom-select').select2();
            $('.custom-select').select2({
              dropdownParent: $("#CreateSchedule"+value)
            });

            $("#CreateSchedule"+value).modal('show');
        });








        $(document).on("click", ".filtered", function () {
            var value= $(this).attr('data-item');
            var rel= $(this).attr('rel');
            var ref= $(this).attr('ref');



            var group_id= $(this).attr('group_id');
            var groupArray = group_id.split(",");            

            var location_id= $(this).attr('location_id');
            var locationArray = location_id.split(",");            

            var assignments= $(this).attr('assignments');
            var assignmentArray = assignments.split("-|-");


            $("#pills-tabContent").hide();
            $("#UpdateScheduleLoading").show();
         



            $("#UpdateScheduleHeader").html(`Update Schedule ${ref}`);

            
            const myArray = rel.split("-|-");
            
            $("#customer_id").val(myArray[0]);

            $.each(assignmentArray, function(key, option){
                $('#assignment10').append(option);
            });
            $('#assignment10').trigger('change'); 

            $('#location_ids0').val(locationArray);
            $('#location_ids0').trigger('change'); 

            $('#group_ids0').val(groupArray);
            $('#group_ids0').trigger('change'); 

            $("#staff_id").val(myArray[1]);
            $("#hourly_wags").val(myArray[2]);
            $("#date001").val(myArray[3]);
            $("#start_time").val(myArray[4]);
            $("#end_time").val(myArray[5]);
            $("#status").val(myArray[6]);
            $("#visibility").val(myArray[7]);
            $("#schedule_id000").val(myArray[8]);
            $("#note01").val(myArray[9]);
            



            $("#MyUpdateScheduleForm").attr("action",`{{ url('/schedule/update/') }}/${myArray[8]}`);
            $("#MyCopyScheduleForm").attr("action",`{{ url('/schedule/copy/') }}/${myArray[8]}`);
            $("#DeleteSchedule").attr("href",`{{ url('/schedule/delete/') }}/${myArray[8]}`);

            $(".UpdateClose").attr("data-item",value)
            $("#UpdateSchedule").attr("id","UpdateSchedule"+value)
            $("#UpdateSchedule"+value).modal('show');



            get_notes(myArray[8]);


            $('.custom-select').select2();
            $('.custom-select').select2({
              dropdownParent: $("#UpdateSchedule"+value)
            });


            $("#pills-tabContent").show();
            $("#UpdateScheduleLoading").hide();
        });














         // Notes CRUD


         // CREATE        

        $("#MyNoteScheduleForm").on('submit', function(e) {
            e.preventDefault();
            var schedule_id = $('#schedule_id000').val();
            var title = $('#title').val();
            var description = $('#description').val();

            $.ajax({
                url: "{{ url('/schedule/note/store/') }}/"+schedule_id,
                method: "POST",
                data: {
                    title: title,
                    description: description,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#title').val('');
                    $('#description').val('');
                    get_notes(schedule_id);

                    tata.success('Success...', response.message, {
                      position: 'tr',
                      duration: 5000,
                      animate: 'slide'
                    })


                    
                    $(".CreateNoteContainer").hide();
                }
            });

        });



      



        




        // GET
        function get_notes(id)
        {
            var uri = "{{ url('/schedule/notes/') }}/"+id;
            $.ajax({
                url: uri,
                type: "get",
                success: function(response)
                {
                    // console.log(response.length);

                    
                    $('#notes_list').empty();

                    if(response.length === 0){
                        $('#notes_list').append(`
                            <h5 class='pt-3'>No record found...</h5>
                        `);
                        
                    }else{

                        response.forEach(function(note){
                            
                            var note_id = note.id;
                            var title = note.title;
                            var description = note.description;



                            var tr_str1 = `
                                <tr>
                                    <td class="w-75">
                                        <b>${title}</b> <br>
                                        ${description}
                                        <i data-feather="trash-2"></i>
                                    </td>


                                    <td class="w-25" style="vertical-align: middle !important;">
                                        <a rel="${note_id}" rel1="${id}" class="btn btn-danger btn-sm" id="DeleteNote" href="javascript::"><i data-feather="trash-2"></i>
                                            Delete
                                        </a>



                                        
                                    </td>


                                </tr>

                            `;
                            
                            
                            $("#notes_list").append(tr_str1);
                            
                        })
                    }
                   
                    
                    
                }

                    
            });
        }


        // Delete
        $("#notes_list").on('click', '#DeleteNote', function () {
            let schedule_id00 = $(this).attr("rel");
            let schedule_id = $(this).attr("rel1");


            var uri = "{{ url('/schedule/note/delete/') }}/"+schedule_id00;
            $.ajax({
                url: uri,
                type: "get",
                success: function(response)
                {
                    get_notes(schedule_id);

                    tata.success('Success...', response.message, {
                      position: 'tr',
                      duration: 5000,
                      animate: 'slide'
                    });                    
                }

                    
            });

        });

    </script>
@endsection