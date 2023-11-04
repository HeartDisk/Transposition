<?PHP
class TranspositionIO {
    public function read($inputFile) {
        try {
            $inputData = file_get_contents($inputFile);
            $inputJSON = json_decode($inputData, true);
            if ($inputJSON === null) 
            {
                die("Error: Invalid JSON data in the input file.\n");
            }
            $tones['musicalPiece'] = $inputJSON['musicalPiece'];
            $tones['semitonesToTranspose'] = $inputJSON['semitones'];
            return $tones;
        }
        catch(Exception $e) {
            die($e->getMessage());   }
    }

    public function write($outputFile,$transposedPiece)
    {
        // Prepare the output JSON
        $outputJSON = json_encode(['transposedPiece' => $transposedPiece], JSON_PRETTY_PRINT);        
        file_put_contents($outputFile, $outputJSON);
    }
    
    
}
