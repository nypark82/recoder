 $(function(){
	createTable(99999);
	$('#sort').change(function(){
		// value値を取得
		t_id = $("#sort").val();
		createTable(t_id);
	});
		function createTable(t_id){
			$.ajax({
				url:'api/list_api.php',
				type:'get',
				dataType:'json',
				data:{'t_id': t_id}  
			}).done(function(d){
				//table header作成
				let header = ['試験名','正答率','試験日','編集'];
				$('#rows').empty();
				$('#rows').append('<table>');
				$('#rows table').append('<tr>');
				for(let i = 0; i < header.length; i++){
					$('#rows tr').append('<th>' + header[i] + '</th>');
				}
				for(let j = 0; j < d.length; j++){
					//試験名追加
					let tr = $('<tr>');
					let name = $('<td>');
					let span = $('<span>').addClass('v_name');
					span.text('(' + d[j].v_name + ')');
					let a = $('<a>').attr('href', 'detail.php?t_id=' + d[j].t_id + '&v_id=' + d[j].v_id);
					a.text(d[j].t_name);
					a.append(span);
					name.append(a);
					//点数追加
					let score = $('<td>');
					score.addClass('num_center');
					score.text(d[j].score + '%');
					//日付追加
					let days = $('<td>');
					let c_day = d[j].c_day;
					c_day = c_day.slice(0, -8);
					days.text(c_day);
					//編集追加
					let edit = $('<td>');
					edit.addClass('num_center');
					let a_edit = $('<a>').attr('href', 'form.php?s_id=' + d[j].s_id);
					a_edit.text('編集');
					edit.append(a_edit);
					tr.append(name).append(score).append(days).append(edit);
					$('#rows table').append(tr);
				}
			}).fail(function(){
				alert('NG');
			});
		};	
});