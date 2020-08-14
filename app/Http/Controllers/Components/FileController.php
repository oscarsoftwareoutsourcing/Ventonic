<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\UploadRepository;
use App\Document;

class FileController extends Controller
{
    /**
     * Gestiona los documentos a subir
     *
     * @method    uploadDocument
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request             $request    Objeto con datos de la petición
     * @param     UploadRepository    $up         Objeto con información del archivo a subir
     *
     * @return    JsonResponse        Objeto con información de la respuesta
     */
    public function uploadDocument(Request $request, UploadRepository $up)
    {
        $disk = $request->disk ?? 'documents';

        if ($request->file('file')) {
            if ($up->upload($request->file('file'), $disk, true)) {
                $documentPath = $up->getStoredPath();
                $documentUrl = $up->getStored();
            }
        }
        return response()->json([
            'result' => true, 'document_path' => $documentPath, 'document_url' => $documentUrl
        ], 200);
    }

    /**
     * Registra un documento asociado a una negociación
     *
     * @method    setDocument
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request        $request    Objeto con información de la petición
     *
     * @return    JsonResponse   Datos de respuesta a la petición
     */
    public function setDocument(Request $request)
    {
        $this->validate($request, [
            'note' => ['required'],
            'documents' => ['required'],
            'modelRelationId' => ['required']
        ]);

        $model = "App\\" . ucfirst($request->modelRelationClass);

        foreach ($request->documents as $document) {
            Document::create([
                'note' => $request->note,
                'file' => $document['path'],
                'url' => $document['url'],
                'documentable_id' => $request->modelRelationId,
                'documentable_type' => $model,
                'user_id' => auth()->user()->id
            ]);
        }

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene los documentos asociados a una negociación
     *
     * @method    getDocuments
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Negotiation     $negotiation    Objeto con información de la negociación
     *
     * @return    JsonResponse    Objeto con datos de la respuesta a la petición
     */
    public function getDocuments($class, $id)
    {
        /*$documents = [];
        $docNote = '';
        foreach ($negotiation->documents as $document) {
            if ($docNote !== $document->note) {
                $docNote = $document->note;
            }
            $document[$docNote] =
        }*/
        $model = "App\\" . ucfirst($class);
        $record = $model::find($id);

        if (!$record || !method_exists($record, 'documents')) {
            return response()->json(['result' => true, 'documents' => []]);
        }

        return response()->json([
            'result' => true, 'documents' => $record->documents()->orderBy('created_at', 'desc')->get()
        ], 200);
    }

    /**
     * Elimina un archivo del storage
     *
     * @method    deleteDocument
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request           $request    Objeto con información de la petición
     *
     * @return    JsonResponse      Objeto con datos de respuesta a la petición
     */
    public function deleteDocument(Request $request)
    {
        $disk = $request->disk ?? 'documents';
        Storage::disk($disk)->delete($request->file);
        return response()->json(['result' => true], 200);
    }
}
