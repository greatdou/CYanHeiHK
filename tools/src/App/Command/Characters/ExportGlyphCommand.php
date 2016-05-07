<?php

namespace App\Command\Characters;

use App\Command\ContainerAwareCommand;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExportGlyphCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('chardata:export-glyphs')
            ->setDescription('Exports glyphs for reference')
            ->addArgument('codepoint', InputArgument::REQUIRED, 'The codepoint to query')
            ->addArgument('filename', InputArgument::REQUIRED, 'Target path for exported content (weight and extension will be appended automatically)')
            ->addOption('weight', 'w', InputOption::VALUE_REQUIRED, 'Specify the weight to act upon', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Export glyphs for reference');
        $io = new SymfonyStyle($input, $output);

        $database = $this->getCharacterDatabase();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM cmap WHERE codepoint = :codepoint');

        $cids = [];
        $codepoints = explode(',', $input->getArgument('codepoint'));
        foreach ($codepoints as $codepoint) {
            $inputCodepoint = $codepoint;
            if (preg_match('/^U\+?([A-F0-9]+)/i', $codepoint, $matches)) {
                $codepoint = hexdec($matches[1]);
            }
            if (!is_numeric($codepoint)) {
                throw new InvalidArgumentException('Codepoint ' . $codepoint . ' invalid');
            }

            $stmt->execute(['codepoint' => $codepoint]);
            $rows = $stmt->fetchAll();
            if (count($rows)) {
                $row = $rows[0];
                foreach (['jp', 'kr', 'cn', 'tw'] as $lang) {
                    if ($row['cid_' . $lang]) {
                        $cids[$row['cid_' . $lang]] = true;
                    }
                }
            } else {
                $io->error('Warning: codepoint' . $inputCodepoint . ' not found!');
            }
        }

        $cids = array_keys($cids);
        $afdkoBinDir = $this->getParameter('afdko_bin_dir');
        $filename = $input->getArgument('filename');
        $weights = $this->getActionableWeights($input->getOption('weight'));

        foreach ($weights as $weight) {
            $shsPsFile = $this->getSourceHanSansPsFilePath($weight);
            $pfaFile = $filename . '_' . $weight . '.pfa';

            $io->text(' - Producing PFA file');
            $cmd = sprintf('%s/tx -t1 -decid -g %s %s %s',
                $afdkoBinDir,
                implode(',', $cids),
                $shsPsFile,
                $pfaFile);

            $this->runExternalCommand($io, $cmd);
        }
    }
}
