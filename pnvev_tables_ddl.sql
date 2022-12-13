-- pnvev_dashboard.pnvev_administrative_regions definition

CREATE TABLE `pnvev_administrative_regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forms_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `map_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_age_groups definition

CREATE TABLE `pnvev_age_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `family` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_disease_v2s definition

CREATE TABLE `pnvev_disease_v2s` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `case_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tendencies_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `children_tendencies_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distribution_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regions_heatmap_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `districts_heatmap_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_epiweek definition

CREATE TABLE `pnvev_epiweek` (
  `SemanaEpidemiologica` int(11) NOT NULL,
  `Inicio` date NOT NULL,
  `Fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_genders definition

CREATE TABLE `pnvev_genders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_key_value definition

CREATE TABLE `pnvev_key_value` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_password_resets definition

CREATE TABLE `pnvev_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `pnvev_password_resets_email_index` (`email`) USING BTREE,
  KEY `pnvev_password_resets_token_index` (`token`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- pnvev_dashboard.pnvev_users definition

CREATE TABLE `pnvev_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnvev_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;