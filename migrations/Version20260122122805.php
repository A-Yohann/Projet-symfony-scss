<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260122122805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil_conservation ADD CONSTRAINT FK_7A24AFA160BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conseil_conservation ADD CONSTRAINT FK_7A24AFA1BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_horloge (id)');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2EDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE piece_horlogere ADD CONSTRAINT FK_EF67AEEE6A99F74A FOREIGN KEY (membre_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE piece_horlogere ADD CONSTRAINT FK_EF67AEEEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_horloge (id)');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme ADD CONSTRAINT FK_16DFCB69266F5DE9 FOREIGN KEY (piece_horlogere_id) REFERENCES piece_horlogere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme ADD CONSTRAINT FK_16DFCB693FC0D758 FOREIGN KEY (mecanisme_id) REFERENCES mecanisme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP nom');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil_conservation DROP FOREIGN KEY FK_7A24AFA160BB6FE6');
        $this->addSql('ALTER TABLE conseil_conservation DROP FOREIGN KEY FK_7A24AFA1BCF5E72D');
        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2EDA76ED395');
        $this->addSql('ALTER TABLE piece_horlogere DROP FOREIGN KEY FK_EF67AEEE6A99F74A');
        $this->addSql('ALTER TABLE piece_horlogere DROP FOREIGN KEY FK_EF67AEEEBCF5E72D');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme DROP FOREIGN KEY FK_16DFCB69266F5DE9');
        $this->addSql('ALTER TABLE piece_horlogere_mecanisme DROP FOREIGN KEY FK_16DFCB693FC0D758');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL');
    }
}
