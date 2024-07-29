<a href="home.php"  <?php if(!empty($menu_id) && $menu_id==1){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Home</a>
<a href="display.php"  <?php if(!empty($menu_id) && $menu_id==2){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Users</a>
<a href="change.php"  <?php if(!empty($menu_id) && $menu_id==4){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Change Password</a>
<a href="regenerate.php"  <?php if(!empty($menu_id) && $menu_id==5){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Regenerate PC</a>
<a href="logout.php" class="list-group-item" >Logout</a>
