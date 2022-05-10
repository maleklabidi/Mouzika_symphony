<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510173217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE albums (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, number_of_songs INT NOT NULL, release_date DATE NOT NULL, genre VARCHAR(255) NOT NULL, artist VARCHAR(255) NOT NULL, image_album VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, Titre VARCHAR(20) NOT NULL, Description VARCHAR(20) NOT NULL, id_user_id INT NOT NULL, rating DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (IdEvent INT AUTO_INCREMENT NOT NULL, NomEvent VARCHAR(10) NOT NULL, nomArtiste VARCHAR(30) NOT NULL, LocalisationEvent VARCHAR(10) NOT NULL, DateEvent DATE NOT NULL, PRIMARY KEY(IdEvent)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nouveautes (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, rating INT NOT NULL, userid INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisateur (IdOrganisateur INT AUTO_INCREMENT NOT NULL, NomOrganisateur VARCHAR(10) NOT NULL, PrenomOrganisateur VARCHAR(10) NOT NULL, UsernameOrganisateur VARCHAR(10) NOT NULL, MdpOrganisateur INT NOT NULL, PRIMARY KEY(IdOrganisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (idauditeur INT DEFAULT NULL, IdParticipation INT AUTO_INCREMENT NOT NULL, IdEventParticipation INT DEFAULT NULL, INDEX IdEventParticipation (IdEventParticipation, idauditeur), INDEX IdAuditeur (IdAuditeur), INDEX IDX_AB55E24FD54BF72C (IdEventParticipation), PRIMARY KEY(IdParticipation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotions (id INT AUTO_INCREMENT NOT NULL, id_prod_id INT NOT NULL, pourcentage INT NOT NULL, duree INT NOT NULL, UNIQUE INDEX UNIQ_EA1B3034DF559605 (id_prod_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(50) NOT NULL, reponse VARCHAR(20) NOT NULL, duree INT NOT NULL, idPromo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE singles (id INT AUTO_INCREMENT NOT NULL, albums_id INT DEFAULT NULL, artist VARCHAR(255) NOT NULL, single_name VARCHAR(255) NOT NULL, release_date DATE NOT NULL, genre VARCHAR(255) NOT NULL, image_single VARCHAR(255) NOT NULL, audio_single VARCHAR(255) NOT NULL, INDEX IDX_7FAFC0ECECBB55AF (albums_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (IdTicket INT AUTO_INCREMENT NOT NULL, ReferenceTicket INT NOT NULL, PRIMARY KEY(IdTicket)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE titres (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, rating DOUBLE PRECISION NOT NULL, artiste VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, mdp VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, role VARCHAR(50) NOT NULL, numtel_user INT DEFAULT NULL, adresse_user VARCHAR(50) DEFAULT NULL, connected INT DEFAULT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FD54BF72C FOREIGN KEY (IdEventParticipation) REFERENCES event (IdEvent)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F2CA3331E FOREIGN KEY (idauditeur) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B3034DF559605 FOREIGN KEY (id_prod_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE singles ADD CONSTRAINT FK_7FAFC0ECECBB55AF FOREIGN KEY (albums_id) REFERENCES albums (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE singles DROP FOREIGN KEY FK_7FAFC0ECECBB55AF');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FD54BF72C');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B3034DF559605');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F2CA3331E');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE nouveautes');
        $this->addSql('DROP TABLE organisateur');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE promotions');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE singles');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE titres');
        $this->addSql('DROP TABLE user');
    }
}
