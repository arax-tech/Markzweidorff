@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
    <script>
        /*==============-==================*/
        //        Global Variable          //
        /*=================================*/
        var global_staff_id;
        var global_staff_text;



        /*===========================================*/
        //          Drag and Drop Function           //
        /*===========================================*/
        $( ".schedule-item-list" ).droppable({
            accept: ".schedule-dragable-item",
            classes: {"ui-droppable-active": "ui-state-active", "ui-droppable-hover": "ui-state-hover"},
            drop: function( event, ui ) {

                const schedule_id = ui.draggable.attr("data-id");
                var target_date = $(this).attr('date');
                var target_user_id = $(this).attr('user-id');
                const type = "{{ request()->active }}";


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
                        console.log("Error: "+ resp);
                    }
                });
            }
        });

        $(".schedule-dragable-item").draggable({
            containment: $(".drag-container"),
            revert: "invalid",
        });





        /*===========================================*/
        //      Right Click on Schedule One          //
        /*===========================================*/
        $(function(){
            $.contextMenu({
                selector: '.context-menu-one',
                className: 'context-menu-one-title',
                trigger: 'right',
                callback: function(key, options) {


                    const contextMenuDataId = options.$trigger.attr("data-id");
                    const contextMenuRef = options.$trigger.attr("ref");
                    const scheduleID = options.$trigger.attr("id");

                    var ref = options.$trigger.attr('ref');
                    var vehicle_id = options.$trigger.attr('vehicle_id');
                    var assignment_id = options.$trigger.attr('assignment-id');

                    if (key === "edit") {
                        
                        global_staff_id = "";
                        global_staff_text = "";
                        setTimeout(() => {
                            $('select[name="assignment"]').val(assignment_id).trigger('change');
                            $('#vehicle_id').val(vehicle_id).trigger('change');
                        }, 800);
                        global_staff_id = options.$trigger.attr('staff-id');
                        global_staff_text = options.$trigger.attr('staff-text');
                        const schedule_id = options.$trigger.attr('data-id');
                        get_schedule_info(schedule_id, ref);
                        $('.DayCheckBox').trigger('change');


                    }else if(key == "cut"){
                        sessionStorage.setItem("schedule___id", contextMenuDataId);
                        sessionStorage.setItem("action___type", "Cut");
                        $(".context-menu-one").css("border", "1px solid lightgray");
                        $(`#${scheduleID}`).css("border", "2px solid #f53b57");
                    }else if(key == "copy"){
                        sessionStorage.setItem("schedule___id", contextMenuDataId);
                        sessionStorage.setItem("action___type", "Copy");
                    }else if(key == "delete"){
                        // window.location.replace(`{{ url('/schedule/delete/') }}/${contextMenuDataId}`);
                        var url = `{{ url('/schedule/delete/') }}/${contextMenuDataId}`;
                         $.ajax({
                             type: 'get',
                             url: url,
                             success: function(resp) {
                                 $(`#${scheduleID}`).css("display", "none");
                             },
                             error: function(resp) {
                                console.log("Error: "+ resp);
                             }
                         });
                    }else if(key == "Pending"){
                        window.location.replace(`{{ url('/schedule/update/status/') }}/Pending/${contextMenuDataId}`);
                    }else if(key == "Accepted"){
                        window.location.replace(`{{ url('/schedule/update/status/') }}/Accepted/${contextMenuDataId}`);
                    }else if(key == "Declined"){
                        window.location.replace(`{{ url('/schedule/update/status/') }}/Declined/${contextMenuDataId}`);
                    }
                },
                items: {
                    "edit": {name: "Rediger vagt", icon: "edit"},
                    "cut": {name: "Klip vagt", icon: "cut"},
                    "copy": {name: "Kopier vagt", icon: "copy"},
                    "fold1a": {name: "Status ændring", icon: "edit",
                        "items": {
                            "Pending": {"name": "Afventer", icon: "edit"},
                            "Accepted": {"name": "Accepteret", icon: "edit"},
                            "Declined": {"name": "Afvist", icon: "edit"}
                        }
                    },
                    "sep1": "---------",
                    "delete": {name: "Slet vagt", icon: "delete"},
                }
            });
        });





        /*===========================================*/
        //      Right Click on Schedule Two          //
        /*===========================================*/
        $(function(){
            $.contextMenu({
                selector: '.context-menu-two',
                className: 'context-menu-two-title',
                trigger: 'right',
                callback: function(key, options) {

                    var date= options.$trigger.attr('date');
                    var refDate= options.$trigger.attr('ref-date');
                    var userId= options.$trigger.attr('user-id');



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
                                     date: date,
                                     user_id: userId,
                                     type: type,
                                 },
                                 success: function(resp) {
                                     // sessionStorage.clear();
                                     location.reload();
                                 },
                                 error: function(resp) {
                                    console.log("Error: "+ resp);
                                 }
                             });
                        }
                    }else if(key === "add"){

                        get_customer_assignments(userId);
                        $("#CreateScheduleHeader").html(`Schedule for ${refDate}`);

                        @if (request()->active == "Customer")
                            $("#customer_id11").val(userId);
                            $('#customer_id11').trigger('change');
                        @else
                            $("#staff_id1").val(userId);
                            $('#staff_id1').trigger('change');
                        @endif
                        $("#date1").val(date);


                        $('.custom-select').select2();
                        $('.custom-select').select2({
                          dropdownParent: $("#CreateSchedule")
                        });
                        $("#CreateSchedule").modal('show');

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
                    "paste": {name: "Indsæt vagt", icon: "paste"},
                    "add": {name: "Opret ny vagt", icon: "add"},
                    // "availability": {name: "remove", icon: "add"},

                }
            });
        });



        $(document).on("click", ".CreateClose", function () {
            $('#staff_id1').empty();
            $('#group_ids').val("");
        })

        


        /*==============-==================*/
        //        Update Schedule          //
        /*=================================*/
        $(document).on("click", ".UpdateScheduleFunction", function () {
            global_staff_id = "";
            global_staff_text = "";
            var ref = $(this).attr('ref');
            var vehicle_id = $(this).attr('vehicle_id');
            var assignment_id = $(this).attr('assignment-id');
            setTimeout(() => {
                $('select[name="assignment"]').val(assignment_id).trigger('change');
                $('#vehicle_id').val(vehicle_id).trigger('change');
            }, 800);
            global_staff_id = $(this).attr('staff-id');
            global_staff_text = $(this).attr('staff-text');
            const schedule_id = $(this).attr('data-id');
            get_schedule_info(schedule_id, ref);
            get_notes(schedule_id);
            get_applications(schedule_id);
            $('.DayCheckBox').trigger('change');
        });

        $("#close_staff").on("click", function () {
            $('#staff_id').val('0').trigger('change');
        })


        /*===============================*/
        //      Create Schedule          //
        /*===============================*/
        $(document).on("click", ".OpenCreateModal", function () {

            var date= $(this).attr('date');
            var refDate= $(this).attr('ref-date');
            var userId= $(this).attr('user-id');



            var location_id= $(this).attr('location');
            var group_id= $(this).attr('group');
            // alert(userId);

            if (location_id != null || location_id != "") {
                const locations = location_id.split(",");
                $('#location_ids').val(locations);
                $('#location_ids').trigger('change');
            }


            get_customer_assignments(userId);
            $("#CreateScheduleHeader").html(`Schedule for ${refDate}`);

            @if (request()->active == "Customer")
                $("#customer_id11").val(userId);
                $('#customer_id11').trigger('change');
            @elseif (userId > 0) {
                $("#staff_id1").val(userId);
                $('#staff_id1').trigger('change');
            }
            @endif
            $("#date1").val(date);


            $('.custom-select').select2();
            $('.custom-select').select2({
              dropdownParent: $("#CreateSchedule")
            });
            $("#CreateSchedule").modal('show');
        });


        // -------------------------------------//
        //       Get Customer Assignments       //
        // -------------------------------------//
        function get_customer_assignments(customer_id) {
            var url = "{{ url('/schedule/get/customer/assignments/') }}/"+customer_id;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                    if (response.location_id !== null) {
                        const locations = response.location_id.split(",");
                        $('#location_ids').val(locations);
                        $('#location_ids').trigger('change');

                        $('#location_ids0').val(locations);
                        $('#location_ids0').trigger('change');
                    }

                    $('select[name="assignment"]').empty();
                    $('select[name="assignment"]').append('<option value="">Vælg...</option>');
                    $.each(response.assignments, function(key, value){
                        $('select[name="assignment"]').append('<option value="'+key+'">'+ value +'</option>');
                    });
                },
                error: function(resp) {
                    console.log("Error: "+ resp);
                }
            });
        }

      




        // ------------------------------------------------//
        //          Get Users by Loaction & Group          //
        // ------------------------------------------------//

        function update_get_users_by_location_and_group(group_ids, location_ids, staff_ids, staff_text) {
            if ($("#CreateSchedule").hasClass("show") && $("#CreateSchedule").css('display').toLowerCase() == 'block') {
                // console.log("CreateSchedule");
            }else{
            // var id_found = false;
            var url = "{{ url('/schedule/get/user/by/location/and/group/') }}/"+group_ids+"/"+location_ids;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                    // console.log(response);
                        $("#PersonaleLength").html(Object.keys(response).length);
                        $("#PersonaleLength1").html(Object.keys(response).length);

                        $('#staff_id').empty();
                        $('#staff_id').append(`
                            <option value="${staff_ids}">${staff_text}</option>
                        `);
                        if (staff_ids != 0) {
                            $('select[name="staff_id"]').append('<option value="0">Åbne vagter</option>');
                        }
                        $.each(response, function(key, data){
                            if (staff_ids != data.id) {
                                $('#staff_id').append(`
                                    <option value="${data.id}">${data.name} || ${data.groups}</option>
                                `);
                            }

                        });
                },
                error: function(resp) {
                    console.log("Error: "+ resp);
                }
            });
            }
        }



        function get_users_by_location_and_group(group_ids, location_ids, selected_users_ids) {
            if ($("#UpdateSchedule").hasClass("show") && $("#UpdateSchedule").css('display').toLowerCase() == 'block') {
                // console.log("UpdateSchedule");
            }else{
            // console.log(group_ids);
            // console.log(location_ids);
            // console.log(selected_users_ids);
            var id_found = false;
            var url = "{{ url('/schedule/get/user/by/location/and/group/') }}/"+group_ids+"/"+location_ids;
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                    // console.log(response);
                        $("#PersonaleLength").html(Object.keys(response).length);
                        $("#PersonaleLength1").html(Object.keys(response).length);
                        $('#staff_id1 option').each(function(){
                            var option_val = $(this).val();
                            if (option_val != selected_users_ids) {
                                $(this).remove();
                            }else{
                                id_found = true;
                            }
                        })
                        // $('select[name="staff_id"]').empty();
                        if (id_found == false) {
                            $('#staff_id1').append('<option value="0">Åbne vagter</option>');
                        }
                        $.each(response, function(key, data){
                            if (selected_users_ids != data.id) {
                                $('#staff_id1').append(`
                                    <option value="${data.id}">${data.name} || ${data.groups}</option>
                                `);
                            }

                        });
                },
                error: function(resp) {
                    console.log("Error: "+ resp);
                }
            });
        }
        }

        // ----------------------------------------//
        //       Customer on Chnage Function       //
        // ----------------------------------------//

        $('select[name="customer_id"]').on('change', function() {
            get_customer_assignments(this.value);
        });




        $('#location_ids').on('change', function() {
            setTimeout(() => {
                var selected_location_ids = $('#location_ids option:selected').toArray().map(item => item.value);
                var selected_users_ids = $('#staff_id1 option:selected').val();
                var selected_group_ids  = $('#group_ids option:selected').toArray().map(item => item.value);
                var location_id = 0;
                if (selected_location_ids.length > 0) {
                    location_id = selected_location_ids;
                }else{
                    location_id = 0;
                }
                var group_id = 0;
                if (selected_group_ids.length == 0) {
                    get_users_by_location_and_group(group_id, location_id, selected_users_ids);
                }else{
                    get_users_by_location_and_group(selected_group_ids, location_id, selected_users_ids);
                }
            }, 100);
        });


        $('#location_ids0').on('change', function() {
            setTimeout(() => {
                var selected_location_ids = $('#location_ids0 option:selected').toArray().map(item => item.value);
                var selected_group_ids  = $('#group_ids0 option:selected').toArray().map(item => item.value);
                var location_id = 0;
                if (selected_location_ids.length > 0) {
                    location_id = selected_location_ids;
                }else{
                    location_id = 0;
                }
                var group_id = 0;
                if (selected_group_ids.length == 0) {
                    update_get_users_by_location_and_group(group_id, location_id, global_staff_id, global_staff_text);
                }else{
                    update_get_users_by_location_and_group(selected_group_ids, location_id, global_staff_id, global_staff_text);
                }
            }, 100);
        });



        $('#group_ids').on('change', function() {
            var selected_users_ids = $('#staff_id1 option:selected').val();
                var location_id = $('#location_ids').val();
                if (location_id == null || location_id == "") {
                    location_id = 0;
                }
                var group_id = $(this).val();
                if (group_id == null || group_id == "") {
                    group_id = 0;
                }
                get_users_by_location_and_group(group_id, location_id, selected_users_ids);
        });

        $('#group_ids0').on('change', function() {
            var location_id = $('#location_ids0').val();
            if (location_id == null || location_id == "") {
                location_id = 0;
            }
            var group_id = $(this).val();
            if (group_id == null || group_id == "") {
                group_id = 0;
            }
            update_get_users_by_location_and_group(group_id, location_id, global_staff_id, global_staff_text);
        });




        $('select[name="visibility"]').on('change', function() {
            var value = $(this).val();
            // alert(value);
            if (value === "Published") {
                $("#visibility_icon").html(`<i class="me-1" data-feather="eye"></i>`);
                $("#visibility_icon1").html(`<i class="me-1" data-feather="eye"></i>`);
            }else if (value === "NotPublished") {
                $("#visibility_icon").html(`<i class="me-1" data-feather="eye-off"></i>`);
                $("#visibility_icon1").html(`<i class="me-1" data-feather="eye-off"></i>`);
            }
            feather.replace();
        });


        $('select[name="status"]').on('change', function() {
            var value = $(this).val();
            // alert(value);
            if (value === "Pending") {
                $("#status_icon").html(`<i class="me-1" data-feather="help-circle"></i>`);
                $("#status_icon1").html(`<i class="me-1" data-feather="help-circle"></i>`);
            }else if (value === "Accepted") {
                $("#status_icon").html(`<i class="me-1" data-feather="check-circle"></i>`);
                $("#status_icon1").html(`<i class="me-1" data-feather="check-circle"></i>`);
            }else if (value === "Declined") {
                $("#status_icon").html(`<i class="me-1" data-feather="alert-circle"></i>`);
                $("#status_icon1").html(`<i class="me-1" data-feather="alert-circle"></i>`);
            }
            feather.replace();
        });



        // -------------------------//
        //       Get All Application       //
        // -------------------------//
        function get_applications(id)
        {
            // console.log('called')
            var uri = "{{ url('/schedule/application/') }}/"+id;
            $.ajax({
                url: uri,
                type: "get",
                success: function(response)
                {
                    console.log(response)

                    $('#applied_list').empty();
                    if(response.length === 0){
                        $('#applied_list').append(`
                            <h5 class='pt-3'>No record found...</h5>
                        `);

                    }else{

                        response.forEach(function(application){

                            var application_id = application.id;
                            var user_id = application.user_id;
                            var email = application.email;
                            var name = application.name;
                            var image = application.image;
                            var accepted = application.accepted;
                            var created_at = application.created_at1;

                            var imageUrl = "";
                            if (image != null) {
                                imageUrl = `<img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/profile/') }}/${image}" />`;
                            }else{
                                imageUrl = `<img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/placeholder.jpg') }}" />`
                            }

                            var newButton = "";
                            if (accepted === 0) {
                                newButton = `<a onclick="return confirm('Are you sure to confirm ?')" class="btn btn-success btn-sm" href="{{ url('/schedule/application/approved/') }}/${application_id}">Tildel vagt</a>`;
                            }else{
                                newButton = `<a class="btn btn-success disabled btn-sm" href="javascript::">Applicaiton is Confirmed</a>`;
                            }


                            var groups_array = [];

                            console.log(application.groups)
                            application.groups.forEach(function(group){
                                groups_array.push(`
                                    <span style="background: ${group.background} !important; color: ${group.color} !important; margin-right:5px; margin-left:-5px" class="badge">
                                        ${group.name}
                                    </span>  
                                `);
                            });


                            var tr_str1 = `
                                <tr>
                                    <td class="w-50">
                                        <a target="_blank" href="{{ url('/user/view/') }}/${user_id}" class="d-flex flex-row align-items-center">
                                            ${imageUrl}
                                            <div class="flex-column ml-2 text-dark" style="margin-left:10px">
                                                <span>${name}</span/> <br/>
                                                <div class="d-flex flex-row flex-wrap" style="margin-top:5px">${groups_array}</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;" class="w-25" >${created_at}</td>


                                    <td class="w-25" style="vertical-align: middle !important;">
                                        ${newButton}
                                    </td>


                                </tr>

                            `;


                            $("#applied_list").append(tr_str1);

                        })
                    }



                }


            });
        }


        // -------------------------------------//
        //       Get Scheduel Information       //
        // -------------------------------------//
        function get_schedule_info(schedule_id, ref) {

            $("#pills-tabContent").hide();
            $("#UpdateScheduleLoading").show();

            $("#UpdateScheduleHeader").html(`Update Schedule ${ref}`);
            $("#MyUpdateScheduleForm").attr("action",`{{ url('/schedule/update/') }}/${schedule_id}`);
            $("#MyCopyScheduleForm").attr("action",`{{ url('/schedule/copy/') }}/${schedule_id}`);
            $("#DeleteSchedule").attr("href",`{{ url('/schedule/delete/') }}/${schedule_id}`);

            var url = "{{ url('/schedule/by/id/') }}/"+schedule_id;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                    // console.log(response.vehicle_id);
                    $("#customer_id").val(response.customer_id);
                    $('#customer_id').trigger('change');
                    $("#staff_id").val(response.staff_id);
                    $('#staff_id').trigger('change');
                    $("#date001").val(response.date);
                    $("#start_time").val(response.start_time);
                    $("#end_time").val(response.end_time);

                    if (response.status === "Pending") {
                        $("#status_icon").html(`<i class="me-1" data-feather="help-circle"></i>`);
                    }else if (response.status === "Accepted") {
                        $("#status_icon").html(`<i class="me-1" data-feather="check-circle"></i>`);
                    }else if (response.status === "Declined") {
                        $("#status_icon").html(`<i class="me-1" data-feather="alert-circle"></i>`);
                    }
                    feather.replace();


                    $("#status").val(response.status);


                    if (response.customer_loactions !== null) {
                        const locations0 = response.customer_loactions.split(",")
                        $("#location_ids0").val(locations0);
                        $('#location_ids0').trigger('change');
                    }

                    if (response.staff_groups !== null) {
                        const groups0 = response.staff_groups.split(",")
                        $("#group_ids0").val(groups0);
                        $('#group_ids0').trigger('change');
                    }

                    $("#visibility").val(response.visibility);


                    if (response.visibility === "Published") {
                        $("#visibility_icon").html(`<i class="me-1" data-feather="eye"></i>`);
                    }else if (response.visibility === "NotPublished") {
                        $("#visibility_icon").html(`<i class="me-1" data-feather="eye-off"></i>`);
                    }
                    feather.replace();

                    $("#schedule_id000").val(response.id);
                    $("#note01").val(response.notes);

                    $('.custom-select').select2();
                    $('.custom-select').select2({
                      dropdownParent: $("#UpdateSchedule")
                    });

                    $("#pills-tabContent").show();
                    $("#UpdateScheduleLoading").hide();
                },
                error: function(resp) {
                    console.log("Error: "+ resp);
                }
            });



            $("#UpdateSchedule").modal('show');
        }

















        /*=====================================*/
        //        Schedule Notes CRUD          //
        /*==============-======================*/



        // ------------------------//
        //       Create Note       //
        // ------------------------//
        $("#MyNoteScheduleForm").on('submit', function(e) {
            e.preventDefault();
            var schedule_id = $('#schedule_id000').val();
            var title = $('#title').val();
            var description = $('#description').val();
            var visibility = $('#visibility000').val();

            $.ajax({
                url: "{{ url('/schedule/note/store/') }}/"+schedule_id,
                method: "POST",
                data: {
                    title: title,
                    description: description,
                    visibility: visibility,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#title').val('');
                    $('#description').val('');
                    $("#visibility000").prop( "checked", false );
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

        $(".CreateNoteContainer").hide();
        $(".CreateNoteBtn").click(function(){
            $(".CreateNoteContainer").show();
        });

        $(".CreateNoteClose").click(function(){
            $(".CreateNoteContainer").hide();
        });




        // -------------------------//
        //       Get All Note       //
        // -------------------------//
        function get_notes(id)
        {
            var uri = "{{ url('/schedule/notes/') }}/"+id;
            $.ajax({
                url: uri,
                type: "get",
                success: function(response)
                {

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
                            var visibility = note.visibility;



                            var tr_str1 = `
                                <tr>
                                    <td class="w-50">
                                        <b>${title}</b> <br>
                                        ${description}
                                    </td>
                                    <td class="w-25" >${visibility}</td>


                                    <td class="w-25" style="vertical-align: middle !important;">
                                        <a rel="${note_id}" rel1="${id}" class="btn btn-danger btn-sm" id="DeleteNote" href="javascript::">Delete</a>
                                    </td>


                                </tr>

                            `;


                            $("#notes_list").append(tr_str1);

                        })
                    }



                }


            });
        }


        // ------------------------//
        //       Delete Note       //
        // ------------------------//
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









        /*==============-============================*/
        //        Get UnPublished Schedule           //
        /*==============-============================*/
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
                    console.log("Error: "+ resp);
                }
            });
        });













        /*==============-============================*/
        //        Not Woking Schedule CRUD           //
        /*==============-============================*/


        // -----------------//
        //       Create     //
        // -----------------//

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

        $('#status0').on('change', function() {
            var value = $(this).val();
            // alert(value);
            if (value === "NotWork") {
                $("#CanNotWorkStatus").html(`<i class="me-1" data-feather="thumbs-down"></i>`);
            }else if(value === "Work") {
                $("#CanNotWorkStatus").html(`<i class="me-1" data-feather="thumbs-up"></i>`);
            }else{
                $("#CanNotWorkStatus").html(`<i class="me-1" data-feather="coffee"></i>`);
            }
            feather.replace();
        });

        $(".time_not_working").hide();
        $("#all-days-switch").on('change', function() {
            if($(this).is(":checked")) {
                $(".time_not_working").hide();
            }else{
                $(".time_not_working").show();
            }
        });

        // -----------------//
        //       Update     //
        // -----------------//

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
                    $("#NotWorkingForm").attr("action",`{{ url('/schedule/not/working/update/') }}/${id}`);
                    $("#notWorkingActionA").attr("href",`{{ url('/schedule/not/working/delete/') }}/${id}`);
                    $("#staff_id0").val(response.staff_id);
                    $("#customer_id0").val(response.customer_id);
                    $("#date0").val(response.date);
                    $("#start_time_not").val(response.start_time);
                    $("#end_time_not").val(response.end_time);
                    $("#note0").val(response.note);
                    $("#status0").val(response.status);

                    if (response.status === "NotWork") {
                        $("#CanNotWorkStatus").html(`<i class="me-1" data-feather="thumbs-down"></i>`);
                    }else if(response.status === "Work") {
                        $("#CanNotWorkStatus").html(`<i class="me-1" data-feather="thumbs-up"></i>`);
                    }else{
                        $("#CanNotWorkStatus").html(`<i class="me-1" data-feather="coffee"></i>`);
                    }


                    $(".notWorkingActionButton").html('<i class="me-1" data-feather="edit-2"></i> Update');
                    $(".NotWorkingModalTitlle").html('<i class="me-1" data-feather="edit-2"></i>Update Tilgængelighed');

                    if(response.allDay == "Null"){
                        $(".time_not_working").show();
                        $("#all-days-switch").prop( "checked", false );
                    }else{
                        $("#all-days-switch").prop( "checked", true );
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
                    console.log("Error: "+ resp);
                }
            });

        });

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

            $("#all-days-switch").prop( "checked", true );
            $(".time_not_working").hide();


            feather.replace();
            $("#CanNotWork").modal('hide');
        });












        /*==============================*/
        //      Other Functions        //
        /*=============================*/
        $(document).ready(function() {
            $('.custom-select').select2();
        });



        // $(function() {
        //     $(this).bind("contextmenu", function(e) {
        //         e.preventDefault();
        //     });
        // });








        $('#CheckAllDays').change(function () {
            $('.DayCheckBox').prop('checked',this.checked);
            $('.DayCheckBox').trigger('change');
        });

        $('#SameStaff').change(function () {
            var checked = false;
            if ($(this).prop('checked') != false) {
                checked = true;
            }
            $('.SameStaffBox').each(function(){
                if ($(this).prop('disabled') == false && checked == true) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
            $('.DayCheckBox').trigger('change');
        });

        $('#ToggleVisibility').change(function () {
            // alert($(this).val());
            var checked = false;
            if ($(this).prop('checked') != false) {
                checked = true;
            }
            $('.ToggleVisibilityValue').each(function(){
                if ($(this).prop('disabled') == false && checked == true) {
                    $(this).val('NotPublished').change();
                } else {
                    $(this).val('Published').change();
                }
            });
            $('.DayCheckBox').trigger('change');
        });

        $('.DayCheckBox').change(function () {
            if ($(this).prop('checked') == true) {
                var rowData = $(this).attr("data-row");
               $('.ToggleVisibilityValue').each(function(){
                    if ($(this).attr("data-row") == rowData) {
                        $(this).prop('disabled', false);
                    }
                });
                $('.SameStaffBox').each(function(){
                    if ($(this).attr("data-row") == rowData) {
                        $(this).prop('disabled', false);
                    }
                });
                $('.CopyValue').each(function(){
                    if ($(this).attr("data-row") == rowData) {
                        $(this).prop('disabled', false);
                    }
                });
            } else {
                var rowData = $(this).attr("data-row");
                $('.ToggleVisibilityValue').each(function(){
                    if ($(this).attr("data-row") == rowData) {
                        $(this).val('Published').change();
                        $(this).prop('disabled', true);
                    }
                });
                $('.SameStaffBox').each(function(){
                    if ($(this).attr("data-row") == rowData) {
                        $(this).prop('checked', false);
                        $(this).prop('disabled', true);
                    }
                });
                $('.CopyValue').each(function(){
                    if ($(this).attr("data-row") == rowData) {
                        $(this).val('1').change();
                        $(this).prop('disabled', true);
                    }
                });
            }
        });


    </script>
@endsection
