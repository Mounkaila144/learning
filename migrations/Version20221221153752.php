<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221153752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cour (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, contenue LONGTEXT DEFAULT NULL, INDEX IDX_A71F964F5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_ED767E4FE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur_formation (formateur_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_52449B08155D8F51 (formateur_id), INDEX IDX_52449B085200282E (formation_id), PRIMARY KEY(formateur_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, duree VARCHAR(10) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payement (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, date DATETIME NOT NULL, prix INT NOT NULL, UNIQUE INDEX UNIQ_B20A78855200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, naissance DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_formation (user_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_40A0AC5BA76ED395 (user_id), INDEX IDX_40A0AC5B5200282E (formation_id), PRIMARY KEY(user_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cour ADD CONSTRAINT FK_A71F964F5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE formateur_formation ADD CONSTRAINT FK_52449B08155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateur_formation ADD CONSTRAINT FK_52449B085200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A78855200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE user_formation ADD CONSTRAINT FK_40A0AC5BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_formation ADD CONSTRAINT FK_40A0AC5B5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cour DROP FOREIGN KEY FK_A71F964F5200282E');
        $this->addSql('ALTER TABLE formateur_formation DROP FOREIGN KEY FK_52449B08155D8F51');
        $this->addSql('ALTER TABLE formateur_formation DROP FOREIGN KEY FK_52449B085200282E');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A78855200282E');
        $this->addSql('ALTER TABLE user_formation DROP FOREIGN KEY FK_40A0AC5BA76ED395');
        $this->addSql('ALTER TABLE user_formation DROP FOREIGN KEY FK_40A0AC5B5200282E');
        $this->addSql('DROP TABLE cour');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formateur_formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE payement');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_formation');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
