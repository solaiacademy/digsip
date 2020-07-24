/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.13-MariaDB : Database - digsipdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`digsipdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `digsipdb`;

/*Table structure for table `arsip_kepegawaian` */

DROP TABLE IF EXISTS `arsip_kepegawaian`;

CREATE TABLE `arsip_kepegawaian` (
  `id_arsip` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `doc_name` varchar(100) DEFAULT NULL,
  `doc_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_arsip`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `arsip_kepegawaian` */

insert  into `arsip_kepegawaian`(`id_arsip`,`id_user`,`doc_name`,`doc_file`) values (30,1,'martin-ktp-kubar','KTP-martin.jpg'),(31,1,'martin-bpjs','BPJS_martin.pdf'),(32,1,'martin-kk','KK.pdf');

/*Table structure for table `arsip_nilai` */

DROP TABLE IF EXISTS `arsip_nilai`;

CREATE TABLE `arsip_nilai` (
  `id_arsip` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(200) NOT NULL,
  `doc_file` varchar(100) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_arsip`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `arsip_nilai` */

insert  into `arsip_nilai`(`id_arsip`,`doc_name`,`doc_file`,`tahun`,`semester`,`kelas`,`deskripsi`) values (5,'Rekap Nilai','DB_-_SMK.xlsx','2019','Ganjil','XI TKJ','Rekap nilai dibuat oleh wali kelas Martinus Mai');

/*Table structure for table `arsip_siswa` */

DROP TABLE IF EXISTS `arsip_siswa`;

CREATE TABLE `arsip_siswa` (
  `id_arsip` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(12) DEFAULT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `doc_number` varchar(100) NOT NULL,
  `doc_file` varchar(100) DEFAULT NULL,
  `doc_date` date DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_arsip`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `arsip_siswa` */

insert  into `arsip_siswa`(`id_arsip`,`nis`,`nama_siswa`,`doc_name`,`doc_number`,`doc_file`,`doc_date`,`deskripsi`) values (2,'102','Jamil Mirdad','Surat Panggilan Pertama','307','BIODOTA_Pelatihan_TIK.docx','2020-07-02','Sembarangan');

/*Table structure for table `arsip_tatausaha` */

DROP TABLE IF EXISTS `arsip_tatausaha`;

CREATE TABLE `arsip_tatausaha` (
  `id_arsip` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(200) NOT NULL,
  `doc_clasification` varchar(20) NOT NULL,
  `doc_category` int(11) NOT NULL,
  `doc_file` varchar(200) NOT NULL,
  `doc_date` date NOT NULL,
  `doc_number` int(11) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_arsip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `arsip_tatausaha` */

insert  into `arsip_tatausaha`(`id_arsip`,`doc_name`,`doc_clasification`,`doc_category`,`doc_file`,`doc_date`,`doc_number`,`deskripsi`) values (2,'Laporan Perkembangan PPDB','Surat Keluar',12,'Laporan_Perkembangan_CSB-SMKN_1_Linggang_Bigung_Thn_2020.pdf','2020-05-03',307,'Laporan perkembangan penerimaan siswa baru tahun 2020, dibuat oleh Martinus Mai, S.kom'),(4,'Draft surat ijin tidak masuk sekolah','Draft',12,'Surat_Ijin_Tidak_Masuk.docx','2020-06-02',0,'Ini hanya contoh surat ijin tidak masuk, silahkan disesuaikan ');

/*Table structure for table `jenis_surat` */

DROP TABLE IF EXISTS `jenis_surat`;

CREATE TABLE `jenis_surat` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_surat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_surat` */

insert  into `jenis_surat`(`id_surat`,`jenis_surat`) values (1,'Surat Dinas'),(2,'Nota Dinas'),(3,'Surat Pengantar'),(4,'Draft Administrasi'),(5,'Surat Keputusan'),(6,'Surat Edaran'),(7,'Surat Undangan'),(8,'Surat Tugas'),(9,'Surat Kuasa'),(10,'Surat Pengumuman'),(11,'Surat Pernyataan'),(12,'Surat Keterangan'),(13,'Berita Acara'),(14,'Surat Kawat'),(15,'Petunjuk Teknis'),(16,'Absensi'),(17,'Memo');

/*Table structure for table `kepegawaian` */

DROP TABLE IF EXISTS `kepegawaian`;

CREATE TABLE `kepegawaian` (
  `user_id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(6) NOT NULL,
  `tingkat_pendidikan` varchar(20) NOT NULL,
  `status_pegawai` varchar(20) NOT NULL,
  `tmt_awal` date NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kepegawaian` */

insert  into `kepegawaian`(`user_id`,`nik`,`tempat_lahir`,`tgl_lahir`,`jenis_kelamin`,`tingkat_pendidikan`,`status_pegawai`,`tmt_awal`,`jabatan`,`no_hp`) values (1,'6407070211870001','Kelimali','1987-11-02','Pria','S3','PNS','2019-03-03','Waka Sarpras','085385778335'),(2,'6407072011900001','Sintang','1990-11-20','Wanita','S1','PNS','2020-03-03','Guru Mapel','082254109040'),(3,'6407070211850001','Tering Seberang','2985-11-02','Pria','S1','Honorer Provinsi','2014-03-03','Staff TU','085385773333');

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `activity` varchar(300) NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert  into `log`(`id_log`,`id_user`,`date`,`activity`) values (1,3,1593174222,'User logout'),(2,1,1593174250,'User login'),(3,1,1593174262,'User logout'),(4,1,1593174270,'User login'),(5,1,1593174288,'User logout'),(6,3,1593174939,'User login'),(7,3,1593174945,'User logout'),(8,1,1593176153,'User login'),(9,1,1593176157,'User logout'),(10,1,1593182109,'User login'),(11,1,1593186148,'User logout'),(12,3,1593186156,'User login'),(13,3,1593186200,'User logout'),(14,3,1593186209,'User login'),(15,3,1593187028,'User logout'),(16,3,1593187035,'User login'),(17,3,1593187477,'User logout'),(18,3,1593187484,'User login'),(19,3,1593187609,'User logout'),(20,3,1593187618,'User login'),(21,3,1593188033,'User logout'),(22,3,1593188042,'User login'),(23,3,1593188338,'User logout'),(24,3,1593188345,'User login'),(25,3,1593188363,'User logout'),(26,1,1593188369,'User login'),(27,1,1593188385,'User logout'),(28,26,1593188423,'User login'),(29,26,1593188552,'User logout'),(30,3,1593188559,'User login'),(31,3,1593189816,'User logout'),(32,3,1593189823,'User login'),(33,3,1593190240,'User logout'),(34,2,1593190250,'User login'),(35,2,1593324817,'User login'),(36,2,1593334722,'User logout'),(37,1,1593334730,'User login'),(38,1,1593336204,'User logout'),(39,2,1593336213,'User login'),(40,2,1593340311,'User logout'),(41,1,1593340324,'User login'),(42,1,1593341407,'User logout'),(43,2,1593341415,'User login'),(44,2,1593341673,'User logout'),(45,1,1593341686,'User login'),(46,22,1593349906,'User logout'),(47,2,1593349918,'User login'),(48,2,1593349929,'User logout'),(49,1,1593349937,'User login'),(50,2,1593352332,'User login'),(51,2,1593352350,'User logout'),(52,1,1593352364,'User login'),(53,1,1593396452,'User login'),(54,1,1593407110,'User logout'),(55,3,1593407118,'User login'),(56,3,1593409007,'User logout'),(57,1,1593409016,'User login'),(58,1,1593414686,'User logout'),(59,1,1593414692,'User login'),(60,1,1593415427,'User logout'),(61,1,1593415433,'User login'),(62,1,1593415689,'User login'),(63,1,1593416062,'User logout'),(64,2,1593416127,'User login'),(65,2,1593416808,'User logout'),(66,1,1593416815,'User login'),(67,1,1593416823,'User logout'),(68,3,1593416836,'User login'),(69,3,1593418828,'User logout'),(70,3,1593418837,'User login'),(71,3,1593419036,'User logout'),(72,1,1593419042,'User login'),(73,1,1593419457,'User logout'),(74,2,1593419462,'User login'),(75,2,1593419497,'User logout'),(76,3,1593419503,'User login'),(77,3,1593419536,'User logout'),(78,1,1593419546,'User login'),(79,1,1593419559,'User logout'),(80,2,1593419580,'User login'),(81,2,1593422550,'User logout'),(82,1,1593422557,'User login'),(83,1,1593473998,'User login'),(84,1,1593475655,'User logout'),(85,2,1593475673,'User login'),(86,2,1593475684,'User logout'),(87,3,1593475689,'User login'),(88,3,1593475747,'User logout'),(89,1,1593475757,'User login'),(90,1,1593480183,'User logout'),(91,3,1593480192,'User login'),(92,3,1593480294,'User logout'),(93,1,1593480300,'User login'),(94,1,1593504335,'User login'),(95,1,1593775195,'User login'),(96,1,1593777140,'User logout'),(97,2,1593777151,'User login'),(98,2,1593778741,'User logout'),(99,3,1593778747,'User login'),(100,3,1593779784,'User logout'),(101,2,1593779797,'User login'),(102,2,1593781208,'User logout'),(103,1,1593781214,'User login'),(104,1,1593820228,'User login'),(105,1,1593953485,'User login'),(106,1,1593959886,'User logout'),(107,1,1593963366,'User login'),(108,1,1593963888,'User logout'),(109,1,1594000192,'User login'),(110,1,1594017388,'User logout'),(111,1,1594017397,'User login'),(112,1,1594017447,'User logout'),(113,3,1594017456,'User login'),(114,3,1594017512,'User logout'),(115,1,1594017520,'User login'),(116,1,1594034555,'User login'),(117,1,1594035891,'User logout'),(118,3,1594035898,'User login'),(119,3,1594036463,'User logout'),(120,2,1594036471,'User login'),(121,2,1594036505,'User logout'),(122,1,1594036558,'User login'),(123,1,1594038946,'User logout'),(124,3,1594038956,'User login'),(125,3,1594041254,'User logout'),(126,3,1594041261,'User login'),(127,3,1594041291,'User logout'),(128,1,1594041298,'User login'),(129,1,1594120096,'User login'),(130,1,1594121031,'User login'),(131,1,1594133448,'User add menu Arsip TU'),(132,1,1594134014,'User logout'),(133,3,1594134022,'User login'),(134,1,1594168507,'User login'),(135,1,1594186843,'User logout'),(136,3,1594186857,'User login'),(137,3,1594189264,'User logout'),(138,1,1594189274,'User login'),(139,1,1594203076,'User login'),(140,1,1594210487,'User add menu Role Nomor Surat'),(141,1,1594347640,'User login'),(142,1,1594357224,'User login'),(143,1,1594365123,'User login'),(144,1,1594377397,'User login'),(145,1,1594389766,'User add menu Coba'),(146,3,1594435599,'User login'),(147,3,1594436145,'User logout'),(148,1,1594436153,'User login'),(149,1,1594436171,'User logout'),(150,3,1594436180,'User login'),(151,3,1594436643,'User logout'),(152,1,1594436651,'User login'),(153,1,1594436699,'User logout'),(154,2,1594436706,'User login'),(155,2,1594440086,'User logout'),(156,1,1594440092,'User login'),(157,1,1594440109,'User logout'),(158,3,1594440119,'User login'),(159,3,1594440140,'User logout'),(160,3,1594440153,'User login'),(161,3,1594440163,'User logout'),(162,2,1594440170,'User login'),(163,2,1594440186,'User logout'),(164,3,1594440192,'User login');

/*Table structure for table `nomor_surat` */

DROP TABLE IF EXISTS `nomor_surat`;

CREATE TABLE `nomor_surat` (
  `doc_number` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`doc_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nomor_surat` */

insert  into `nomor_surat`(`doc_number`,`user_id`,`deskripsi`,`date_created`) values (305,1,'Surat Undangan Rapat Ortu/Wali',1552579759),(306,1,'Surat pengantar pertemuan bendahara di Melak',1594219706);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`email`,`image`,`password`,`role_id`,`is_active`,`date_created`) values (1,'Martinus Mai, S.Kom','inerie379@gmail.com','martin.png','$2y$10$hoaWw8PeZu3YcI9CMS/HwObEOyfMuJc6GiY2Jwqs54eiYwmQJQ6u6',1,1,1552579759),(2,'Titi Susanti, S.Pd','titisusanti@gmail.com','titi-diklat.jpg','$2y$10$Cw15wII24FVBjYJYhAaVLebyJhOX6kiqw47phmu2vtp0sIU4f9S0.',3,1,1552618943),(3,'Joko Tingkir','jokosendawar@gmail.com','default.jpg','$2y$10$hoaWw8PeZu3YcI9CMS/HwObEOyfMuJc6GiY2Jwqs54eiYwmQJQ6u6',2,1,1554093897);

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values (1,1,1),(2,1,2),(3,2,2),(4,1,3),(5,1,5),(6,3,2),(7,3,4),(8,1,4),(9,3,5),(10,2,4),(11,1,7),(12,2,7),(13,3,7),(14,1,6),(15,2,6),(16,3,6);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`,`menu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`) values (1,'Admin'),(2,'User'),(3,'Menu'),(4,'GTK'),(5,'Tata Usaha'),(6,'Kesiswaan'),(7,'Kurikulum');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values (1,'Administration'),(2,'Member'),(3,'Operator');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`url`,`icon`,`is_active`) values (1,1,'Dashboard','admin','fas fa-fw fa-tachometer-alt',1),(2,2,'My Profile','user','fas fa-fw fa-user',1),(3,2,'Edit Profile','user/edit','fas fa-fw fa-user-edit',1),(4,3,'Menu Management','menu','fas fa-fw fa-align-justify',1),(5,3,'Submenu Management','menu/submenu','fab fa-fw fa-mendeley',1),(6,1,'Role','admin/role','fas fa-fw fa-user-tie',1),(7,2,'Change Password','user/changepassword','fas fa-fw fa-key',1),(8,4,'Informasi Pribadi','user/infopribadi','fa fa-chalkboard-teacher',1),(9,5,'Informasi Kepegawaian','user/kepegawaian','fas fa-users',1),(10,7,'Arsip Nilai','kurikulum','fa fa-folder-open',1),(11,6,'Arsip Siswa','kesiswaan','fa fa-folder-open',1),(12,4,'Arsip TU','user/arsiptu','fa fa-folder-open',1),(13,5,'Nomor Surat','user/nomorsurat','fa fa-list-ol',1),(14,4,'Role Nomor Surat','user/rolenomorsurat','fa fa-dice',1);

/*Table structure for table `user_token` */

DROP TABLE IF EXISTS `user_token`;

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_token` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
