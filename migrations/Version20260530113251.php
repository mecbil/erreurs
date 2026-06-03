<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260530113251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE matiere_id matiere_id INT NOT NULL, CHANGE nom nom_cat VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE erreur ADD erreur_txt VARCHAR(500) NOT NULL, ADD correction_txt VARCHAR(500) NOT NULL, DROP erreur, DROP correction, CHANGE statut statut_err VARCHAR(20) NOT NULL, CHANGE added added_err DATETIME NOT NULL, CHANGE revision revision_err DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE erreur ADD CONSTRAINT FK_980709A365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE matiere CHANGE nom nom_mat VARCHAR(100) NOT NULL, CHANGE couleur couleur_mat VARCHAR(7) NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie CHANGE nom nom_sous_cat VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634F46CD258');
        $this->addSql('ALTER TABLE categorie CHANGE matiere_id matiere_id INT DEFAULT NULL, CHANGE nom_cat nom VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE erreur DROP FOREIGN KEY FK_980709A365BF48');
        $this->addSql('ALTER TABLE erreur ADD erreur VARCHAR(500) NOT NULL, ADD correction VARCHAR(500) NOT NULL, DROP erreur_txt, DROP correction_txt, CHANGE statut_err statut VARCHAR(20) NOT NULL, CHANGE added_err added DATETIME NOT NULL, CHANGE revision_err revision DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere CHANGE nom_mat nom VARCHAR(100) NOT NULL, CHANGE couleur_mat couleur VARCHAR(7) NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('ALTER TABLE sous_categorie CHANGE nom_sous_cat nom VARCHAR(100) NOT NULL');
    }
}
