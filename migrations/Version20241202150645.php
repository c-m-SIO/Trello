<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202150645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cartes (id INT AUTO_INCREMENT NOT NULL, colonnes_id INT DEFAULT NULL, id_carte INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, date_fin_prevu DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, INDEX IDX_D8B8955569EE6C70 (colonnes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cartes_user (cartes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_287717C0C5BA6C52 (cartes_id), INDEX IDX_287717C0A76ED395 (user_id), PRIMARY KEY(cartes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colonnes (id INT AUTO_INCREMENT NOT NULL, projets_id INT DEFAULT NULL, id_colonne INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, INDEX IDX_6ADAB2FE597A6CB7 (projets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projets (id INT AUTO_INCREMENT NOT NULL, id_projet INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, id_tag INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_cartes (tags_id INT NOT NULL, cartes_id INT NOT NULL, INDEX IDX_BD6328658D7B4FB4 (tags_id), INDEX IDX_BD632865C5BA6C52 (cartes_id), PRIMARY KEY(tags_id, cartes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, id_user VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_ID_USER (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_projets (user_id INT NOT NULL, projets_id INT NOT NULL, INDEX IDX_EC59DFD1A76ED395 (user_id), INDEX IDX_EC59DFD1597A6CB7 (projets_id), PRIMARY KEY(user_id, projets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cartes ADD CONSTRAINT FK_D8B8955569EE6C70 FOREIGN KEY (colonnes_id) REFERENCES colonnes (id)');
        $this->addSql('ALTER TABLE cartes_user ADD CONSTRAINT FK_287717C0C5BA6C52 FOREIGN KEY (cartes_id) REFERENCES cartes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cartes_user ADD CONSTRAINT FK_287717C0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE colonnes ADD CONSTRAINT FK_6ADAB2FE597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id)');
        $this->addSql('ALTER TABLE tags_cartes ADD CONSTRAINT FK_BD6328658D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_cartes ADD CONSTRAINT FK_BD632865C5BA6C52 FOREIGN KEY (cartes_id) REFERENCES cartes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_projets ADD CONSTRAINT FK_EC59DFD1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_projets ADD CONSTRAINT FK_EC59DFD1597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartes DROP FOREIGN KEY FK_D8B8955569EE6C70');
        $this->addSql('ALTER TABLE cartes_user DROP FOREIGN KEY FK_287717C0C5BA6C52');
        $this->addSql('ALTER TABLE cartes_user DROP FOREIGN KEY FK_287717C0A76ED395');
        $this->addSql('ALTER TABLE colonnes DROP FOREIGN KEY FK_6ADAB2FE597A6CB7');
        $this->addSql('ALTER TABLE tags_cartes DROP FOREIGN KEY FK_BD6328658D7B4FB4');
        $this->addSql('ALTER TABLE tags_cartes DROP FOREIGN KEY FK_BD632865C5BA6C52');
        $this->addSql('ALTER TABLE user_projets DROP FOREIGN KEY FK_EC59DFD1A76ED395');
        $this->addSql('ALTER TABLE user_projets DROP FOREIGN KEY FK_EC59DFD1597A6CB7');
        $this->addSql('DROP TABLE cartes');
        $this->addSql('DROP TABLE cartes_user');
        $this->addSql('DROP TABLE colonnes');
        $this->addSql('DROP TABLE projets');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_cartes');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_projets');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
