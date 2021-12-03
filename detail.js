$(function(){
	let url = new URL(window.location.href);
	let t_id = url.searchParams.get('t_id');
	let v_id = url.searchParams.get('v_id');
	let uniId = [];
	let uniName = [];
	let uniName2 = [];
	let uniId2 = [];
	createH1();
	createSelect(t_id);
	createBars(t_id,v_id);
	setTimeout(function(){ $('#version').val(url.searchParams.get('v_id'))},100);
	$('#test').on('change', function(){
		// value値を取得
		t_id = $("#test").val();
		createSelect(t_id)
		setTimeout(function(){
			v_id = $('#version option:first-child').val();
			createBars(t_id,v_id);
		},100);
	});
	$('#version').change(function(){
		// value値を取得
		v_id = $('#version').val();
		createBars(t_id,v_id);
	});
	//h1のselectを作成
	function createH1(){
		$.ajax({
			url:'api/h1_api.php',
			type:'get',
			dataType:'json',
			data:{}  
		})
		.done(function(d){
			$("#test").empty();
			for(let i=0; i < d.length; i++){
				uniName2[i] = d[i].t_name;
				uniId2[i] = d[i].t_id;
			}
			uniName2 = [...new Set(uniName2)];
			uniId2 = [...new Set(uniId2)];
			for(let i=0; i < uniName2.length; i++){
				$("#test").append($('<option>').text(uniName2[i]).val(uniId2[i]));
			}
			$('#test').val(t_id);
		})
    .fail(function(){
			alert('NG');
		});
	};
		//selectを作成
		function createSelect(t_id){
			$.ajax({
				url:'api/select_api.php',
				type:'get',
				dataType:'json',
				data:{'t_id': t_id}  
			})
			.done(function(d){
				$("#version").empty();
				for(let i=0; i < d.length; i++){
					uniName[i] = d[i].v_name;
					uniId[i] = d[i].v_id;
				}
				uniName = [...new Set(uniName)];
				uniId = [...new Set(uniId)];
				for(let i=0; i < uniName.length; i++){
					$("#version").append($('<option>').html(uniName[i]).val(uniId[i]));
				}
				uniId = [];
				uniName = [];
			})
			.fail(function(){
				alert('NG');
			});
		};
	//読み込み時の処理
	function createBars(t_id,v_id){
		$.ajax({
			url:'api/detail_api.php',
			type:'get',
			dataType:'json',
			data:{'v_id': v_id,'t_id': t_id}  
		})
		.done(function(d){
			$('.x_axis').empty();
      $('#bars').empty();
      let k = 1;
			for(let j=0; j<d.length; j++){
        //barの生成
        let ele = $('<li>');		
				if(d[j].score >= 80){
					(ele).addClass('bar nr_'+ k +' green');
				}else if(d[j].score >= 60){
					(ele).addClass('bar nr_'+ k +' orange');
				}else{
					(ele).addClass('bar nr_'+ k +' red');
				}
				let top = $('<div>');
				top.addClass('top');
				let bottom = $('<div>');
				bottom.addClass('bottom');
				let span = $('<span>');
				span.text(d[j].score + '%');
				ele.append(top).append(bottom).append(span);
				let num = d[j].score;
				num = num * 2.5 + 'px';
				$(ele).css({'height': 0});
				$(ele).animate({'height': num},150);
				$('#bars').append(ele);
				//---------日付を表示------------
				$('#bars li').on('click', function(){
					let index = $('#bars li').index($(this));
					$('#date').text(d[index].created);
				}); 
				//------回目表示する and 日付を表示-----------
				let ele2 = $('<li>');
				let str = k + '回目' + "\n";
				let str2 = str.replace(/\n/g, '<br>');
				let c_day = d[j].c_day;
				let a = c_day.slice(0,10);
				let b = a.slice(5);
				$(ele2).html(str2 + b);
				$('.x_axis').append(ele2);
        k++;
			}
		})
    .fail(function(){
			alert('NG');
		});
	};
});

