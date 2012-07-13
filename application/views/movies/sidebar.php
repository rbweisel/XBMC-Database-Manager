				<script type="text/javascript" src="<?php echo base_url();?>shadowbox/shadowbox.js"></script>
				<script type="text/javascript">
					Shadowbox.init();
				</script>
				<div id="sort"class="toggle">
					<a href="" onclick="return togglehidden('sortcontent');" id="sortlabel">- Sort options -</a>
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
							</tr><tr>
								<td>
									<input type="button" onclick="sortmovies()" value="Refresh"/>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div id="togglelist" class="toggle">
					<a href="" onclick="return togglehidden('list');" id="togglelabel">^ List ^</a>
					<div id="list">
						<!-- Placeholder for movie/show/music list -->
						<script>
							$(document).ready(function()
							{
								$('#sortcontent').hide();
								$('#list').load("movies/getlist");
							});
						</script>
					</div>
				</div>
			</div>
