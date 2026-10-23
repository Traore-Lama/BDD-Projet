<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\PersAdmin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- 1 ADMIN ---
        $admin = new Admin();
        $admin->setEmail('admin@neurolink.fr');
        $admin->setNom('Dupont');
        $admin->setPrenom('Jean');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        // --- 7 PERS ADMIN ---
        $persAdminsData = [
            ['Sophie', 'Martin'],
            ['Pierre', 'Bernard'],
            ['Marie', 'Thomas'],
            ['Paul', 'Petit'],
            ['Julie', 'Robert'],
            ['Michel', 'Richard'],
            ['Sarah', 'Durand']
        ];

        foreach ($persAdminsData as $index => $data) {
            $persAdmin = new PersAdmin();
            $persAdmin->setEmail('persadmin' . ($index + 1) . '@neurolink.fr');
            $persAdmin->setNom($data[1]);
            $persAdmin->setPrenom($data[0]);
            $persAdmin->setBloque(false);
            $persAdmin->setRoles(['ROLE_PERS_ADMIN']);
            $manager->persist($persAdmin);
        }

        // --- 14 MEDECINS ---
        $medecinsData = [
            ['Luc', 'Moreau'],
            ['Claire', 'Laurent'],
            ['Thomas', 'Simon'],
            ['Nathalie', 'Michel'],
            ['David', 'Lefebvre'],
            ['Chloé', 'Leroy'],
            ['Alain', 'Roux'],
            ['Isabelle', 'David'],
            ['Hugo', 'Bertrand'],
            ['Camille', 'Morel'],
            ['Nicolas', 'Fournier'],
            ['Émilie', 'Girard'],
            ['Julien', 'Bonnet'],
            ['Léa', 'Lambert']
        ];

        foreach ($medecinsData as $index => $data) {
            $medecin = new Medecin();
            $medecin->setEmail('medecin' . ($index + 1) . '@neurolink.fr');
            $medecin->setNom($data[1]);
            $medecin->setPrenom($data[0]);
            $medecin->setRoles(['ROLE_MEDECIN']);
            $manager->persist($medecin);
        }

        // --- 24 PATIENTS ---
        $patientsData = [
            ['Lucas', 'Garcia'], ['Emma', 'Martinez'], ['Louis', 'Rousseau'], ['Jade', 'Muller'],
            ['Gabriel', 'Lefevre'], ['Louise', 'Faure'], ['Raphaël', 'Andre'], ['Alice', 'Mercier'],
            ['Arthur', 'Blanc'], ['Lina', 'Guerin'], ['Ethan', 'Boyer'], ['Rose', 'Garnier'],
            ['Paul', 'Chevalier'], ['Anna', 'Francois'], ['Noah', 'Legrand'], ['Mila', 'Gauthier'],
            ['Tom', 'Perrin'], ['Juliette', 'Robin'], ['Hugo', 'Clement'], ['Eva', 'Morin'],
            ['Nathan', 'Nicolas'], ['Inès', 'Henry'], ['Léo', 'Roussel'], ['Zoé', 'Mathieu']
        ];

        foreach ($patientsData as $index => $data) {
            $patient = new Patient();
            $patient->setEmail('patient' . ($index + 1) . '@mail.com');
            $patient->setNom($data[1]);
            $patient->setPrenom($data[0]);
            $patient->setCivilite($data[0] === 'Emma' || $data[0] === 'Jade' || $data[0] === 'Louise' || $data[0] === 'Alice' || $data[0] === 'Lina' || $data[0] === 'Rose' || $data[0] === 'Anna' || $data[0] === 'Mila' || $data[0] === 'Juliette' || $data[0] === 'Eva' || $data[0] === 'Inès' || $data[0] === 'Zoé' ? 'Mme' : 'M.');
            $patient->setTelephone('06' . rand(10000000, 99999999));
            $patient->setAdresse(rand(1, 100) . ' rue des Lilas');
            $patient->setCodePostal(75000 + $index);
            $patient->setVille('Paris');
            $patient->setDateNaiss(new \DateTime('-' . rand(18, 65) . ' years'));
            $patient->setNumDossier('DOS-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT));
            $patient->setEstActif(true);
            $patient->setDateCreation(new \DateTime());
            $patient->setRoles(['ROLE_PATIENT']);
            $manager->persist($patient);
        }

        $manager->flush();
    }
}
