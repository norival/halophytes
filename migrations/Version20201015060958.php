<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201015060958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, abstract LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, first_author_last_name VARCHAR(60) NOT NULL, year SMALLINT NOT NULL, INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, data_type VARCHAR(60) NOT NULL, unit VARCHAR(20) DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, genus VARCHAR(50) NOT NULL, species VARCHAR(50) NOT NULL, variety VARCHAR(60) DEFAULT NULL, INDEX IDX_A50FF712A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species_feature (id INT AUTO_INCREMENT NOT NULL, species_id INT NOT NULL, feature_id INT NOT NULL, state_id INT NOT NULL, article_id INT NOT NULL, user_id INT NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_BD490429B2A1D860 (species_id), INDEX IDX_BD49042960E4B879 (feature_id), INDEX IDX_BD4904295D83CC1 (state_id), INDEX IDX_BD4904297294869C (article_id), INDEX IDX_BD490429A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(60) DEFAULT NULL, lastname VARCHAR(60) DEFAULT NULL, orcid VARCHAR(60) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE species ADD CONSTRAINT FK_A50FF712A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE species_feature ADD CONSTRAINT FK_BD490429B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
        $this->addSql('ALTER TABLE species_feature ADD CONSTRAINT FK_BD49042960E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id)');
        $this->addSql('ALTER TABLE species_feature ADD CONSTRAINT FK_BD4904295D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE species_feature ADD CONSTRAINT FK_BD4904297294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE species_feature ADD CONSTRAINT FK_BD490429A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE species_feature DROP FOREIGN KEY FK_BD4904297294869C');
        $this->addSql('ALTER TABLE species_feature DROP FOREIGN KEY FK_BD49042960E4B879');
        $this->addSql('ALTER TABLE species_feature DROP FOREIGN KEY FK_BD490429B2A1D860');
        $this->addSql('ALTER TABLE species_feature DROP FOREIGN KEY FK_BD4904295D83CC1');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE species DROP FOREIGN KEY FK_A50FF712A76ED395');
        $this->addSql('ALTER TABLE species_feature DROP FOREIGN KEY FK_BD490429A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE species_feature');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE user');
    }
}
