<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260122085300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cotisation (id INT AUTO_INCREMENT NOT NULL, annee INT NOT NULL, montant NUMERIC(10, 0) NOT NULL, payee TINYINT NOT NULL, date_paiement DATETIME DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_AE64D2EDA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2EDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2EDA76ED395');
        $this->addSql('DROP TABLE cotisation');
    }
}
