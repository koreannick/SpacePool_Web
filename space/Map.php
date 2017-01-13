<?
if(!defined("__GAUTECH__"))	 exit;

?>
		<div class="s_view_info_box">
			<div class="s_view_info_map">
				<div class="temp_map">
					<?

					$json_result = geocode($address);

					$data = json_decode($json_result,true);

					$map_x = $data['result']['items'][0]['point']['x'];

					$map_y = $data['result']['items'][0]['point']['y'];
					?>
					<div id="map" style="width:100%;height:500px;">
					</div>
					<script type="text/javascript">
					$(function() {
						var $window = $(window),
							$article = $('#map').parent(),
							magic = 0;

						if ($article[0].tagName === 'BODY') {
							magic = 0;
						}

						//function getMapSize() {
						//	return new naver.maps.Size($article.width(), $window.height() - magic);
						//}

						var map = new naver.maps.Map('map', {
							center: new naver.maps.LatLng(<?=$map_y?>, <?=$map_x?>),
							scaleControl: true,
							logoControl: true,
							mapDataControl: true,
							mapTypeControl: true,
							zoomControl: true,
							zoomControlOptions: {
								position: naver.maps.Position.TOP_LEFT
							},
							//size: getMapSize(),
							minZoom: 1,
							zoom: 12
						});

						var marker = new naver.maps.Marker({
							position: new naver.maps.LatLng(<?=$map_y?>, <?=$map_x?>),
							map: map
						});
						var contentString = [
						        '<div class="iw_inner">',
						        '   <h3><?=$addr1 ?></h3>',
										'   <h3><?=$addr2 ?></h3>',
										'   <h4>연락가능 번호 : <?=$c_phone ?> </h4><br />',
						        // '       <img src="'+ HOME_PATH +'/img/example/hi-seoul.jpg" width="55" height="55" alt="서울시청" class="thumb" /><br />',
						        // '       02-120 | 공공,사회기관 &gt; 특별,광역시청<br />',
						        // '       <a href="http://www.seoul.go.kr" target="_blank">www.seoul.go.kr/</a>',
						        '   </p>',
						        '</div>'
						    ].join('');

						var infowindow = new naver.maps.InfoWindow({
						    content: contentString,
						    maxWidth: 800,
						    backgroundColor: "#eee",
						    borderColor: "#1486b8",
						    borderWidth: 3,
						    anchorSize: new naver.maps.Size(30, 30),
						    anchorSkew: true,
						    anchorColor: "#eee",
						    pixelOffset: new naver.maps.Point(20, -20)
						});
								infowindow.open(map, marker);

						naver.maps.Event.addListener(marker, "click", function(e) {
						    if (infowindow.getMap()) {
						        infowindow.close();
						    } else {
						        infowindow.open(map, marker);
						    }
						});
						// function fitMap() {
						// 	map.setSize(getMapSize());
						// }

						// $window.on("resize", fitMap);
					});
					</script>
				</div>
			</div>
			<div class="s_view_info_map_find">
				<a href="http://map.naver.com/?queryType=departure&elng=<?=$map_x?>&elat=<?=$map_y?>&eText=<?=$company?>&pinType=site&dlevel=12&enc=utf8" class="map_find_btn" target="_blank">
					<span class="map_find_icon">
						<img src="/images/common/mpa_find_icon.png">
					</span>
					<span class="map_find_txt">길찾기</span>
				</a>
			</div>

		</div>
