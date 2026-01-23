<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260122091906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE piece_horlogere (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, annee_fabrication INT NOT NULL, image_url VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL, membre_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, INDEX IDX_EF67AEEE6A99F74A (membre_id), INDEX IDX_EF67AEEEBCF5E72D (categorie_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE piece_horlogere_mecanisme (piece_horlogere_id INT NOT NULL, mecanisme_id INT NOT NULL, INDEX IDX_16DFCB69266F5DE9 (piece_horlogere_id), INDEX IDX_16DFCB693FC0D758 (mecanisme_id), PRIMARY KEY (piece_horlogere_id, mecanisme_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE piece_horlogere ADD CONSTRAINT FK_EF67AEEE6A99F74A FOREIGN KEY (membre_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE piece_horlogere ADD CONSTRAINT FK_EF67AEEEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_horloge (id)');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme ADD CONSTRAINT FK_16DFCB69266F5DE9 FOREIGN KEY (piece_horlogere_id) REFERENCES piece_horlogere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme ADD CONSTRAINT FK_16DFCB693FC0D758 FOREIGN KEY (mecanisme_id) REFERENCES mecanisme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2EDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_horlogere DROP FOREIGN KEY FK_EF67AEEE6A99F74A');
        $this->addSql('ALTER TABLE piece_horlogere DROP FOREIGN KEY FK_EF67AEEEBCF5E72D');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme DROP FOREIGN KEY FK_16DFCB69266F5DE9');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme DROP FOREIGN KEY FK_16DFCB693FC0D758');
        $this->addSql('DROP TABLE piece_horlogere');
        $this->addSql('DROP TABLE piece_horlogere_mecanisme');
        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2EDA76ED395');
    }
}
