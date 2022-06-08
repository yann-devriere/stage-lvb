<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516081349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, jour_premier_entrainement VARCHAR(255) NOT NULL, debut_premier_entrainement TIME NOT NULL, fin_premier_entrainement TIME NOT NULL, jour_deuxieme_entrainement VARCHAR(255) NOT NULL, debut_deuxieme_entrainement TIME NOT NULL, fin_deuxieme_entrainement TIME NOT NULL, deuxieme_entrainement_existe TINYINT(1) NOT NULL, jour_enfants_entrainement VARCHAR(255) NOT NULL, debut_enfants_entrainement TIME NOT NULL, fin_enfants_entrainement TIME NOT NULL, enfants_entrainement_existe TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE horaires');
    }
}
