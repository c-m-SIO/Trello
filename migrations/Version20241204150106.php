<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204150106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cartes (id INT AUTO_INCREMENT NOT NULL, colonnes_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, date_fin_prevu DATETIME NOT NULL, cloture TINYINT(1) NOT NULL, fichier VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_D8B8955569EE6C70 (colonnes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cartes_users (cartes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_80427AACC5BA6C52 (cartes_id), INDEX IDX_80427AAC67B3B43D (users_id), PRIMARY KEY(cartes_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cartes_tags (cartes_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_CA5855AFC5BA6C52 (cartes_id), INDEX IDX_CA5855AF8D7B4FB4 (tags_id), PRIMARY KEY(cartes_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colonnes (id INT AUTO_INCREMENT NOT NULL, projets_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_6ADAB2FE597A6CB7 (projets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projets (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_fin_prevu DATETIME NOT NULL, cloture TINYINT(1) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projets_users (projets_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_B40FAACB597A6CB7 (projets_id), INDEX IDX_B40FAACB67B3B43D (users_id), PRIMARY KEY(projets_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, poste VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cartes ADD CONSTRAINT FK_D8B8955569EE6C70 FOREIGN KEY (colonnes_id) REFERENCES colonnes (id)');
        $this->addSql('ALTER TABLE cartes_users ADD CONSTRAINT FK_80427AACC5BA6C52 FOREIGN KEY (cartes_id) REFERENCES cartes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cartes_users ADD CONSTRAINT FK_80427AAC67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cartes_tags ADD CONSTRAINT FK_CA5855AFC5BA6C52 FOREIGN KEY (cartes_id) REFERENCES cartes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cartes_tags ADD CONSTRAINT FK_CA5855AF8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE colonnes ADD CONSTRAINT FK_6ADAB2FE597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id)');
        $this->addSql('ALTER TABLE projets_users ADD CONSTRAINT FK_B40FAACB597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projets_users ADD CONSTRAINT FK_B40FAACB67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartes DROP FOREIGN KEY FK_D8B8955569EE6C70');
        $this->addSql('ALTER TABLE cartes_users DROP FOREIGN KEY FK_80427AACC5BA6C52');
        $this->addSql('ALTER TABLE cartes_users DROP FOREIGN KEY FK_80427AAC67B3B43D');
        $this->addSql('ALTER TABLE cartes_tags DROP FOREIGN KEY FK_CA5855AFC5BA6C52');
        $this->addSql('ALTER TABLE cartes_tags DROP FOREIGN KEY FK_CA5855AF8D7B4FB4');
        $this->addSql('ALTER TABLE colonnes DROP FOREIGN KEY FK_6ADAB2FE597A6CB7');
        $this->addSql('ALTER TABLE projets_users DROP FOREIGN KEY FK_B40FAACB597A6CB7');
        $this->addSql('ALTER TABLE projets_users DROP FOREIGN KEY FK_B40FAACB67B3B43D');
        $this->addSql('DROP TABLE cartes');
        $this->addSql('DROP TABLE cartes_users');
        $this->addSql('DROP TABLE cartes_tags');
        $this->addSql('DROP TABLE colonnes');
        $this->addSql('DROP TABLE projets');
        $this->addSql('DROP TABLE projets_users');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
