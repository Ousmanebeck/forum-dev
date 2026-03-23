
CREATE DATABASE IF NOT EXISTS `forum`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `forum`;


DROP TABLE IF EXISTS `utilisateurs`;

CREATE TABLE `utilisateurs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(180) NOT NULL,
  `mdp` VARCHAR(255) NOT NULL,
  `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(255) NOT NULL,
  `contenu` TEXT NOT NULL,
  `utilisateur_id` INT UNSIGNED NOT NULL,
  `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_utilisateur_id` (`utilisateur_id`),
  CONSTRAINT `fk_questions_utilisateur`
    FOREIGN KEY (`utilisateur_id`)
    REFERENCES `utilisateurs` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `reponses`;

CREATE TABLE `reponses` (
  `id`            INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `utilisateur_id`        INT UNSIGNED    NOT NULL,
  `question_id`   INT UNSIGNED    NOT NULL,
  `contenu`       TEXT            NOT NULL,
  `date_creation`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_question_id` (`question_id`),
  KEY `idx_utilisateur_id`      (`utilisateur_id`),

  CONSTRAINT `fk_reponses_utilisateur`
    FOREIGN KEY (`utilisateur_id`)
    REFERENCES `utilisateurs` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

  CONSTRAINT `fk_reponses_question`
    FOREIGN KEY (`question_id`)
    REFERENCES `questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;