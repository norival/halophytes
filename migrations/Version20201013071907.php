<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013071907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_23A0E669D86650F ON article (user_id_id)');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, data_type VARCHAR(50) NOT NULL, unit VARCHAR(50) DEFAULT NULL, description CLOB NOT NULL)');
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER NOT NULL, common_name VARCHAR(100) NOT NULL, scientific_name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A50FF7129D86650F ON species (user_id_id)');
        $this->addSql('CREATE TABLE species_feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, species_id_id INTEGER NOT NULL, feature_id_id INTEGER NOT NULL, state_id_id INTEGER NOT NULL, article_id_id INTEGER NOT NULL, user_id_id INTEGER NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_BD490429C6A6D2CB ON species_feature (species_id_id)');
        $this->addSql('CREATE INDEX IDX_BD490429B61A945E ON species_feature (feature_id_id)');
        $this->addSql('CREATE INDEX IDX_BD490429DD71A5B ON species_feature (state_id_id)');
        $this->addSql('CREATE INDEX IDX_BD4904298F3EC46 ON species_feature (article_id_id)');
        $this->addSql('CREATE INDEX IDX_BD4904299D86650F ON species_feature (user_id_id)');
        $this->addSql('CREATE TABLE state (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(20) NOT NULL, description CLOB NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE species_feature');
        $this->addSql('DROP TABLE state');
    }
}
