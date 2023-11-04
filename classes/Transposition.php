<?PHP
class Transposition extends TranspositionIO {
    public function transposeNote($note, $semitones) {
        $octaveNumber = $note[0];
        $noteNumber = $note[1];
    
        // Calculate the new note number after transposition
        $newNoteNumber = $noteNumber + $semitones;
    
        // Check if the new note is out of range
        if ($newNoteNumber < 1 || $newNoteNumber > 12) {
            return false; // Out of range
        }
    
        // Adjust the octave if necessary
        while ($newNoteNumber < 1) {
            $newNoteNumber += 12;
            $octaveNumber--;
        }
    
        while ($newNoteNumber > 12) {
            $newNoteNumber -= 12;
            $octaveNumber++;
        }
    
        return [$octaveNumber, $newNoteNumber];
    }
    
    public function transposePiece($piece, $semitones) 
    {
        $transposedPiece = [];
        foreach ($piece as $note) {
            $transposedNote = $this->transposeNote($note, $semitones);
            if ($transposedNote === false) {
                return false; // Note out of range
            }
            $transposedPiece[] = $transposedNote;
        }
        return $transposedPiece;
    }

    public function responde($inputFile, $outputFile)
    {
        $readNodes = $this->read($inputFile);
        $transposedPiece = $this->transposePiece($readNodes['musicalPiece'], $readNodes['semitonesToTranspose']);
        if ($transposedPiece === false) 
        {
            die("Error: Transposed notes are out of the keyboard range.\n");
        }
        $this->write($outputFile,$transposedPiece);
    }
}
?>