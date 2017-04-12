

<?php 
function pg_connection_string_from_database_url() {	
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}

   $db = pg_connect(pg_connection_string_from_database_url());
	
   if(!$db){
      echo "Error : Unable to open database\n";
   } 

	if(isset($_POST['submit']))
{
	$user = $_POST["user"];
	$pass = $_POST["pass"];
   $sql =<<<EOF
CREATE TABLE `bacsi` (
  `idbs` int(11) NOT NULL,
  `hoten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gioitinh` int(11) NOT NULL,
  `diachi` text COLLATE utf8_unicode_ci NOT NULL,
  `sdt` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chuyenmon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trinhdo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `benhnhan` (
  `idbn` int(11) NOT NULL,
  `hoten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gioitinh` int(11) NOT NULL,
  `diachi` text COLLATE utf8_unicode_ci NOT NULL,
  `sdt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `ctphieukham` (
  `idpk` int(11) NOT NULL,
  `idt` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `lieudung` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `hoadon` (
  `idhd` int(11) NOT NULL,
  `idpk` int(11) NOT NULL,
  `idtt` int(11) NOT NULL,
  `giatien` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `phieukham` (
  `idpk` int(11) NOT NULL,
  `sttkham` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `idbn` int(11) NOT NULL,
  `ketqua` text COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci NOT NULL,
  `ngaykham` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` int(11) NOT NULL,
  `idtt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `phongkham` (
  `idp` int(11) NOT NULL,
  `tenphong` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci NOT NULL,
  `idbs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `taikhoan` (
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `thuoc` (
  `idt` int(11) NOT NULL,
  `tenthuoc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `donvitinh` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dongia` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tieptan` (
  `idtt` int(11) NOT NULL,
  `hoten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gioitinh` int(11) NOT NULL,
  `diachi` text COLLATE utf8_unicode_ci NOT NULL,
  `sdt` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `bacsi`
  ADD PRIMARY KEY (`idbs`),
  ADD KEY `username` (`username`);

ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`idbn`);

ALTER TABLE `ctphieukham`
  ADD KEY `idpk` (`idpk`),
  ADD KEY `idt` (`idt`);

ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`idhd`),
  ADD KEY `idpk` (`idpk`),
  ADD KEY `idtt` (`idtt`);

ALTER TABLE `phieukham`
  ADD PRIMARY KEY (`idpk`),
  ADD KEY `idp` (`idp`),
  ADD KEY `idbn` (`idbn`),
  ADD KEY `idtt` (`idtt`);

ALTER TABLE `phongkham`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `idbs` (`idbs`);

ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `thuoc`
  ADD PRIMARY KEY (`idt`);

ALTER TABLE `tieptan`
  ADD PRIMARY KEY (`idtt`),
  ADD KEY `username` (`username`);

ALTER TABLE `bacsi`
  MODIFY `idbs` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `benhnhan`
  MODIFY `idbn` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `hoadon`
  MODIFY `idhd` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `phieukham`
  MODIFY `idpk` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `phongkham`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `thuoc`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tieptan`
  MODIFY `idtt` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bacsi`
  ADD CONSTRAINT `bacsi_ibfk_1` FOREIGN KEY (`username`) REFERENCES `taikhoan` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ctphieukham`
  ADD CONSTRAINT `ctphieukham_ibfk_1` FOREIGN KEY (`idpk`) REFERENCES `phieukham` (`idpk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctphieukham_ibfk_2` FOREIGN KEY (`idt`) REFERENCES `thuoc` (`idt`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`idpk`) REFERENCES `phieukham` (`idpk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`idtt`) REFERENCES `tieptan` (`idtt`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `phieukham`
  ADD CONSTRAINT `phieukham_ibfk_2` FOREIGN KEY (`idbn`) REFERENCES `benhnhan` (`idbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phieukham_ibfk_3` FOREIGN KEY (`idp`) REFERENCES `phongkham` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phieukham_ibfk_4` FOREIGN KEY (`idtt`) REFERENCES `tieptan` (`idtt`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `phongkham`
  ADD CONSTRAINT `phongkham_ibfk_1` FOREIGN KEY (`idbs`) REFERENCES `bacsi` (`idbs`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tieptan`
  ADD CONSTRAINT `tieptan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `taikhoan` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
   } else {
      echo "Insert complete\n";
   }
   pg_close($db);
}
?>

