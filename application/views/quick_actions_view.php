<div id="quick_actions_container">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" id="action_add" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            Add Shop
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse">
        <div class="panel-body">
          <input type="submit" class="btn" value="Save Shop" id="action_save_add" name="submit"/>
          <input type="button" class="btn" value="Cancel" id="action_cancel_add"/>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" id="action_edit" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
            Edit Shop
          </a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
          <input type="submit" class="btn" value="Save Changes" id="action_save_edit" name="submit"/>
          <input type="button" class="btn" value="Cancel" id="action_cancel_edit"/>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        	<input type="submit" name="submit" value="Delete Shop" class="accordion-toggle" id="action_delete" onclick="return confirmDeletion()" />
        </h4>
      </div>
    </div>
  </div>
</div>