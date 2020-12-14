 window._common = {
 	request: function(url, data, option) {
 		if(!option) option = {};
 		if(!data) data = {};
 	 return new Promise(function(resolve, reject){
      var ajaxRequest = {
        headers: {},
        type: option,
        url: url,
        data: data,
        success: function(response){
        	/*console.log(response)*/
          /*$('loading').hide();
          $('.submit-button').removeClass('disable-click', true);
          document.body.style.cursor = 'default';*/
          return resolve(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
         /* if(jqXHR) {
              jqXHR.textStatus = textStatus;
              jqXHR.errorThrown = errorThrown;
              if(jqXHR.status == 401) {
                window.location.href = $server_routes['admin.manager'];
              }
          }
          _common.showErrorMessage(jqXHR, option.selector);
          $('loading').hide();
          $('.submit-button').removeClass('disable-click', true);
          document.body.style.cursor = 'default';
          return reject(jqXHR);*/
        }
      };

      var i;
      for(i in option) {
        ajaxRequest[i] = option[i];
      }
      console.log(ajaxRequest)
      $.ajax(ajaxRequest);
    });
 	},
 	buildTable: function(props) {
 		if(!data) {
	      console.error('Table selector is not exist');
	      return;
	    }
	    var temp = [], obj;
	    var x;
	    var index = $('#dataTable tr').attr('data-index');
	    for(x in props.data) {
	    	obj = _.clone(props.data[x]);
	    	temp.push('<tr id="'+ obj[index] +'"');
	    	temp.push('>');
		    	$('#dataTable tr').find('th').each(function(e) {
				    thisSelector = $(this);
		    		var column_name = thisSelector.attr('column-name');
		    		var column_status = thisSelector.attr('column-status');
		    		var column_ud = thisSelector.attr('column-ud');
		    		temp.push('<td>');
		    		if (column_status) {
		    			if (obj[column_name] == 1) {
		    				temp.push('Hiện')
		    				return;
		    			} else {
		    				temp.push('Ẩn')
		    				return;
		    			}
		    		}
		    		if (column_name) {
		    			temp.push(obj[column_name]);
		    			return;
		    		} else {
		    			if (column_ud){
		    				temp.push('<a href="javascript:void(0)" data-id="'+obj[index]+'" onclick="editPost(this)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+obj[index]+'" class="btn btn-danger" onclick="deletePost(this)">Delete</a>')
		    			};
		    		}
		    		temp.push('</td>');
				});
			temp.push('</tr>');
	    }
	    if (data.build_mode == 'append') {
	    	$('#dataTable').find('#test').prepend(temp.join(''));
	    }  else {
	    	$('#dataTable').find('#test').html(temp.join(''));
	    }
 	}
 };