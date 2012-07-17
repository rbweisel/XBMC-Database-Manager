				<script type="text/javascript" src="<?php echo base_url();?>shadowbox/shadowbox.js"></script>
				<script type="text/javascript">
					Shadowbox.init();
				</script>
				<div id="sort">
					<div id="sortheading" class="header">
						<a href="" onclick="return togglehidden('sortcontent');" id="sortlabel">- Sort options -</a>
					</div>
					<div id="sortcontent">
						<table border="0">
							<tr>
								<td>
									<p>Sort by:&nbsp;&nbsp;&nbsp;</p>
								</td>
								<td>
									<select name="sortby" SIZE="1" class="sortby">
										<option value="c00" id="title">Title</option>
										<option value="c07" id="year">Year</option>
										<option value="idMovie" id="year">Date Added</option>
									</select>
								</td>
							</tr><tr>
								<td>
									<p>Sort direction:&nbsp;&nbsp;&nbsp;</p>
								</td>
								<td>
									<select name="sortdir" SIZE="1" class="sortdir">
										<option value="ASC" id="asc">Ascending</option>
										<option value="DESC" id="desc">Descending</option>
									</select>
								</td>
							</tr><tr>
								<td>
									<p>Filter:&nbsp;&nbsp;&nbsp;</p>
								</td>
								<td>
									<select name="filterby" size="1" class="filterby">
										<option value="all" id="all">All</option>
										<option value="watched" id="watched">Watched</option>
										<option value="notwatched" id="notwatched">Not watched</option>
									</select>
								</td>
							</tr>
						</table>
						<input type="button" onclick="sortmovies()" value="Refresh"/>
					</div>
				</div>
				<div id="list">
					<div id="listheading" class="header">
						<a href="" onclick="return togglehidden('listcontent');" id="listlabel">^ Movies ^</a>
					</div>
					<div id="listcontent">
						<!-- Placeholder for movie/show/music list -->
						<script>
							$(document).ready(function()
							{
								$('#sortcontent').hide();
								$('#listcontent').load("movies/getlist");
							});
						</script>
					</div>
				</div>
			</div>
