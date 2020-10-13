<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013104031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, user_id, title, url, created_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, url VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, abstract CLOB DEFAULT NULL, CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, user_id, title, url, created_at) SELECT id, user_id, title, url, created_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__feature AS SELECT id, name, data_type, unit, description FROM feature');
        $this->addSql('DROP TABLE feature');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, data_type VARCHAR(60) NOT NULL, unit VARCHAR(20) NOT NULL)');
        $this->addSql('INSERT INTO feature (id, name, data_type, unit, description) SELECT id, name, data_type, unit, description FROM __temp__feature');
        $this->addSql('DROP TABLE __temp__feature');
        $this->addSql('DROP INDEX IDX_A50FF712A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__species AS SELECT id, user_id, common_name, scientific_name, created_at FROM species');
        $this->addSql('DROP TABLE species');
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, created_at DATETIME NOT NULL, common_name VARCHAR(60) NOT NULL, scientific_name VARCHAR(60) NOT NULL, CONSTRAINT FK_A50FF712A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO species (id, user_id, common_name, scientific_name, created_at) SELECT id, user_id, common_name, scientific_name, created_at FROM __temp__species');
        $this->addSql('DROP TABLE __temp__species');
        $this->addSql('CREATE INDEX IDX_A50FF712A76ED395 ON species (user_id)');
        $this->addSql('DROP INDEX IDX_BD490429A76ED395');
        $this->addSql('DROP INDEX IDX_BD4904297294869C');
        $this->addSql('DROP INDEX IDX_BD4904295D83CC1');
        $this->addSql('DROP INDEX IDX_BD49042960E4B879');
        $this->addSql('DROP INDEX IDX_BD490429B2A1D860');
        $this->addSql('CREATE TEMPORARY TABLE __temp__species_feature AS SELECT id, species_id, feature_id, state_id, article_id, user_id, value, created_at, updated_at FROM species_feature');
        $this->addSql('DROP TABLE species_feature');
        $this->addSql('CREATE TABLE species_feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, species_id INTEGER NOT NULL, feature_id INTEGER NOT NULL, state_id INTEGER NOT NULL, article_id INTEGER NOT NULL, user_id INTEGER NOT NULL, value VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_BD490429B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BD49042960E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BD4904295D83CC1 FOREIGN KEY (state_id) REFERENCES state (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BD4904297294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BD490429A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO species_feature (id, species_id, feature_id, state_id, article_id, user_id, value, created_at, updated_at) SELECT id, species_id, feature_id, state_id, article_id, user_id, value, created_at, updated_at FROM __temp__species_feature');
        $this->addSql('DROP TABLE __temp__species_feature');
        $this->addSql('CREATE INDEX IDX_BD490429A76ED395 ON species_feature (user_id)');
        $this->addSql('CREATE INDEX IDX_BD4904297294869C ON species_feature (article_id)');
        $this->addSql('CREATE INDEX IDX_BD4904295D83CC1 ON species_feature (state_id)');
        $this->addSql('CREATE INDEX IDX_BD49042960E4B879 ON species_feature (feature_id)');
        $this->addSql('CREATE INDEX IDX_BD490429B2A1D860 ON species_feature (species_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, user_id, title, url, created_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO article (id, user_id, title, url, created_at) SELECT id, user_id, title, url, created_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__feature AS SELECT id, name, data_type, unit, description FROM feature');
        $this->addSql('DROP TABLE feature');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, data_type VARCHAR(50) NOT NULL COLLATE BINARY, unit VARCHAR(50) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO feature (id, name, data_type, unit, description) SELECT id, name, data_type, unit, description FROM __temp__feature');
        $this->addSql('DROP TABLE __temp__feature');
        $this->addSql('DROP INDEX IDX_A50FF712A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__species AS SELECT id, user_id, common_name, scientific_name, created_at FROM species');
        $this->addSql('DROP TABLE species');
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, created_at DATETIME NOT NULL, common_name VARCHAR(100) NOT NULL COLLATE BINARY, scientific_name VARCHAR(100) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO species (id, user_id, common_name, scientific_name, created_at) SELECT id, user_id, common_name, scientific_name, created_at FROM __temp__species');
        $this->addSql('DROP TABLE __temp__species');
        $this->addSql('CREATE INDEX IDX_A50FF712A76ED395 ON species (user_id)');
        $this->addSql('DROP INDEX IDX_BD490429B2A1D860');
        $this->addSql('DROP INDEX IDX_BD49042960E4B879');
        $this->addSql('DROP INDEX IDX_BD4904295D83CC1');
        $this->addSql('DROP INDEX IDX_BD4904297294869C');
        $this->addSql('DROP INDEX IDX_BD490429A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__species_feature AS SELECT id, species_id, feature_id, state_id, article_id, user_id, value, created_at, updated_at FROM species_feature');
        $this->addSql('DROP TABLE species_feature');
        $this->addSql('CREATE TABLE species_feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, species_id INTEGER NOT NULL, feature_id INTEGER NOT NULL, state_id INTEGER NOT NULL, article_id INTEGER NOT NULL, user_id INTEGER NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO species_feature (id, species_id, feature_id, state_id, article_id, user_id, value, created_at, updated_at) SELECT id, species_id, feature_id, state_id, article_id, user_id, value, created_at, updated_at FROM __temp__species_feature');
        $this->addSql('DROP TABLE __temp__species_feature');
        $this->addSql('CREATE INDEX IDX_BD490429B2A1D860 ON species_feature (species_id)');
        $this->addSql('CREATE INDEX IDX_BD49042960E4B879 ON species_feature (feature_id)');
        $this->addSql('CREATE INDEX IDX_BD4904295D83CC1 ON species_feature (state_id)');
        $this->addSql('CREATE INDEX IDX_BD4904297294869C ON species_feature (article_id)');
        $this->addSql('CREATE INDEX IDX_BD490429A76ED395 ON species_feature (user_id)');
    }
}
