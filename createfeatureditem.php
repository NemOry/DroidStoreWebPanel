<?php 

require_once("header.php"); 

if(!$session->is_logged_in())
{
  header("location: index.php");
}
else
{
  $user = User::get_by_id($session->userid);

  if($user->enabled == DISABLED)
  {
    header("location: index.php");
  }
}

$pathinfo = pathinfo($_SERVER["PHP_SELF"]);
$basename = $pathinfo["basename"];
$currentFile = str_replace(".php","", $basename);

?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
      <form id="theform" class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
        <fieldset>
        <legend>
          Create Featured Item
        </legend>

        <div class="control-group">
          <label class="control-label" for="moto">Photo</label>
          <div class="controls">
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-new thumbnail" style="height: 200px;"><img src="public/img/thumbnail.png" /></div>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 200px; line-height: 20px;"></div>
              <div>
                <span class="btn btn-file">
                  <span class="fileupload-new">Select image</span>
                  <span class="fileupload-exists">Change</span>
                  <input name="MAX_FILE_SIZE" hidden value="2097152" />
                  <input name="picture" type="file" />
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                <a class="mytooltip" data-toggle="tooltip" data-placement="right" 
                  title=
                  "
                    extensions allowed: JPEG/JPG, Up to 2MB, Recommended size: 1920x1186
                  ">
                  <span class="label label">?</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="name">* Name</label>
          <div class="controls">
            <input id="name" name="name" type="text" placeholder="name" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="description">* Description</label>
          <div class="controls">
            <textarea id="description" name="description" class="span8"  placeholder="description" style="width:285px; height:100px"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="appid">* Android Package ID / BlackBerry World App ID</label>
          <div class="controls">
            <input id="appid" name="appid" type="text" placeholder="appid" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="price">* Price</label>
          <div class="controls">
            <input id="price" name="price" type="text" placeholder="price" value="0" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="developer">* Developer</label>
          <div class="controls">
            <input id="developer" name="developer" type="text" placeholder="developer" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="version">* Version</label>
          <div class="controls">
            <input id="version" name="version" type="text" placeholder="version" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="platform">* Platform: android / blackberry</label>
          <div class="controls">
            <input id="platform" name="platform" type="text" placeholder="android / blackberry" value="android" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="priority">* Priority</label>
          <div class="controls">
            <input id="priority" name="priority" type="text" placeholder="priority number" value="100" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="pending">Status</label>
          <div class="controls">
            <input type="hidden" name="pending" value="0" id="btn-input2" />
            <div class="btn-group" data-toggle="buttons-radio">
              <button type="button" value="0" id="btn-enabled2" class="btn active">Approved</button>
              <button type="button" value="1" id="btn-disabled2" class="btn">Pending</button>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="enabled">Access</label>
          <div class="controls">
            <input type="hidden" name="enabled" value="1" id="btn-input3" />
            <div class="btn-group" data-toggle="buttons-radio">
              <button type="button" value="1" id="btn-enabled3" class="btn active">Enabled</button>
              <button type="button" value="0" id="btn-disabled3" class="btn">Disabled</button>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="btncreate"></label>
          <div class="controls">
            <button id="btncreate" name="btncreate" class="btn btn-primary">Create</button>
          </div>
        </div>
        </fieldset>
      </form>
    </div>
    <br /><br /><br /><br />
    <div class="span6 well" style="max-height:800px; height:800px; overflow:scroll;">
      <legend>
          Featured Items <button onclick="loadtable(); return false;" class="btn btn-mini btn-success"><i class="icon-large icon-refresh icon-white"></i></button> <span id="loading" class="label">Loading...</span>
      </legend>
      <div class="input-prepend hide">
        <span class="add-on">Search</span>
        <input class="span12" id="tablesearch" type="text" placeholder="search">
      </div>
      <table id="table" class="table table-bordered">
        
      </table>
    </div>
  </div><!--/row-->
  <script>

  $("#tablesearch").keyup(function()
  {
    loadtable();
  });

  var loading = $("#loading");

  function loadtable()
  {
    
    loading.removeClass("hide");

    $.ajax(
    {
      url: 'includes/webservices/gettable.php?itemtype=featureditem&input='+$("#tablesearch").val(),
      success: function(result) 
      {
        $("#table").html(result);

        loading.addClass("hide");
      }
    });
  }

  loadtable();

  $(document).on("click", ".btndelete", function()
  {
    var id = $(this).find("span").text();

    $(this).text("Processing..");
    $(this).attr("disabled", "disabled");

    $.ajax(
    {
      type: 'get',
      url: 'includes/webservices/delete.php?itemid='+id+'&itemtype=featureditem',
      success: function(result) 
      {
        loadtable();
      }
    });
  });

  $(function () 
  { 

    $("#btncreate").click(function()
    {
      var formData = new FormData($("#theform")[0]);

      $("#btncreate").text("Processing");
      $("#btncreate").attr("disabled", "disabled");

      $.ajax(
      {
        type: 'POST',
        url: 'includes/webservices/createfeatureditem.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() 
        {
            var myXhr = $.ajaxSettings.xhr();

            if(myXhr.upload)
            {
                myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
            }
            return myXhr;
        },
        success: function(result) 
        {
          if(result == "success")
          {
            showToast("Successfully Created", "success");
            $("#btncreate").text("Create");
            $("#btncreate").removeAttr("disabled");
            $('#theform')[0].reset();
            loadtable();
          }
          else
          {
            bootbox.alert(result);
            $("#btncreate").text("Create");
            $("#btncreate").removeAttr("disabled");
          }
        }
      });

      return false;
    });

    $(':file').change(function()
    {
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;
    });

    function progressHandlingFunction(e)
    {
      if(e.lengthComputable)
      {
        // $('.progress').attr({value:e.loaded,max:e.total});
        console.log("progress: " + e.loaded);
      }
    }

    var btns1 = ['btn-enabled1', 'btn-disabled1'];
    var input1 = document.getElementById('btn-input1');

    for(var i = 0; i < btns1.length; i++) 
    {
      document.getElementById(btns1[i]).addEventListener('click', function() 
      {
        input1.value = this.value;
      });
    }

    var btns2 = ['btn-enabled2', 'btn-disabled2'];
    var input2 = document.getElementById('btn-input2');

    for(var i = 0; i < btns2.length; i++) 
    {
      document.getElementById(btns2[i]).addEventListener('click', function() 
      {
        input2.value = this.value;
      });
    }

    var btns3 = ['btn-enabled3', 'btn-disabled3'];
    var input3 = document.getElementById('btn-input3');

    for(var i = 0; i < btns3.length; i++) 
    {
      document.getElementById(btns3[i]).addEventListener('click', function() 
      {
        input3.value = this.value;
      });
    }

    function loadItems()
    {
      $("#loadingindicator").removeClass("hide");

      var itemtype = $("#itemtype").val();

      $.ajax(
      {
        type: 'GET',
        url: 'includes/webservices/getitems.php?itemtype='+itemtype,
        success: function(result) 
        {
          $("#itemid").html(result);
          $("#loadingindicator").addClass("hide");
        }
      });
    }

    loadItems();

    $("#itemtype").click(function()
    {
      loadItems();
    });

  });

  </script>

<?php require_once("footer.php"); ?>